<?php

namespace App;

use App\Models\Artikel;
use App\Models\Audio;
use App\Models\Kegiatan;
use App\Models\Foto;
use App\Models\Publikasi;
use App\Models\Video;
use App\Models\Kerjasama;
use App\Models\Rempah;
use Assert\Assert;
use DateTime;
use Refinery29\Sitemap\Component\Image\Image;
use Refinery29\Sitemap\Component\Image\ImageInterface;
use Refinery29\Sitemap\Component\UrlSet;
use Refinery29\Sitemap\Component\Url;
use Refinery29\Sitemap\Component\News\News;
use Refinery29\Sitemap\Component\News\NewsInterface;
use Refinery29\Sitemap\Component\News\Publication;
use Refinery29\Sitemap\Component\Sitemap;
use Refinery29\Sitemap\Component\SitemapIndex;
use Refinery29\Sitemap\Component\UrlSetInterface;
use Refinery29\Sitemap\Component\Video\VideoInterface;
use Refinery29\Sitemap\Writer\SitemapWriter;
use Refinery29\Sitemap\Writer\UrlSetWriter;
use Refinery29\Sitemap\Writer\UrlWriter;
use XMLWriter;

class Sitemapper
{
    public static function publication()
    {
        return [
            "id" => new Publication("Kementerian Pendidikan, Kebudayaan, Riset, dan Teknologi Indonesia", "id"),
            "en" => new Publication("Indonesia's Ministry of Education, Culture, Research, and Technology", "en")
        ];
    }

    public static function contents()
    {
        return [
            ["article_detail", "articles", Artikel::class],
            ["audio_detail", "audios", Audio::class],
            ["event_detail", "events", Kegiatan::class],
            ["photo_detail", "photos", Foto::class],
            ["publication_detail", "publications", Publikasi::class],
            ["video_detail", "videos", Video::class],
            ["partnership_detail", "partnerships", Kerjasama::class],
        ];
    }

    public static function url(string $u, float $priority)
    {
        $url = new Url($u);
        return $url->withPriority($priority);
    }

    public static function baseUrls()
    {
        $urls = [];
        foreach (["id", "en"] as $lang) {
            $urls[] = Sitemapper::url(route("home." . $lang), 1);
            $urls[] = Sitemapper::url(route("the-route." . $lang), 0.9);
            $urls[] = Sitemapper::url(route("the-trail." . $lang), 0.9);
            $urls[] = Sitemapper::url(route("the-future." . $lang), 0.9);

            $urls[] = Sitemapper::url(route("information." . $lang), 0.8);

            $urls[] = Sitemapper::url(route("contents." . $lang), 0.7);
            $urls[] = Sitemapper::url(route("articles." . $lang), 0.7);
            $urls[] = Sitemapper::url(route("audios." . $lang), 0.7);
            $urls[] = Sitemapper::url(route("events." . $lang), 0.7);
            $urls[] = Sitemapper::url(route("photos." . $lang), 0.7);
            $urls[] = Sitemapper::url(route("publications." . $lang), 0.7);
            $urls[] = Sitemapper::url(route("videos." . $lang), 0.7);
            $urls[] = Sitemapper::url(route("partnerships." . $lang), 0.7);
        }
        return new UrlSet($urls);
    }

    public static function contentUrls(string $baseRouteName, $Class)
    {
        $publisher = Sitemapper::publication();

        $query = $Class::select(
            "judul_indo as title_id",
            "judul_english as title_en",
            "slug as slug_id",
            "slug_english as slug_en",
            "keywords_english as keywords_en",
            "keywords_indo as keywords_id",
            "updated_at",
        )
            ->where("status", "publikasi")
            ->where('published_at', '<=', now());

        $type = $Class == Video::class ? 1 : ($Class == Audio::class ? 2 : 3);
        if ($type === 3) {
            $query->addSelect("thumbnail");
        }

        $urls = [];
        $contents = $query->get();
        foreach ($contents as $content) {
            foreach (["id", "en"] as $lang) {
                $title = $content->{"title_" . $lang};
                $slug = $content->{"slug_" . $lang};
                $keywords = $content->{"keywords_" . $lang};

                if ($slug == "" || $slug == "n/a" || $slug == null || $title == null) {
                    continue;
                }

                $url = new Url(route($baseRouteName . "." . $lang, $slug));
                $news = new News($publisher[$lang], $content->updated_at, $title);
                if ($keywords != "") {
                    $news = $news->withKeywords(explode(",", $keywords));
                }

                $url = $url->withNews([
                    $news
                ]);

                if ($type === 3) {
                    $img = new Image(asset('storage/assets/' . substr($content->getTable(), 0, -1) . '/thumbnail/' . $content->thumbnail));
                    $url = $url->withImages([
                        $img
                    ]);
                }

                array_push($urls, $url);
            }
        }

        return new UrlSet($urls);
    }

    public static function spiceUrls()
    {
        $urls = [];

        $spices = Rempah::select("jenis_rempah as name_id", "jenis_rempah_english as name_en")->get();
        foreach ($spices as $spice) {
            foreach (["id", "en"] as $lang) {
                $url = new Url(route("rempah_detail." . $lang, $spice->{"name_" . $lang}));
                $urls[] = $url->withPriority(0.6);
            }
        }

        return new UrlSet($urls);
    }

    public static function generateBaseSitemap()
    {
        $baseUrls = Sitemapper::baseUrls();
        Sitemapper::writeSitemap($baseUrls, "./public/sitemap/base.xml");
    }

    public static function generateMainSitemapIndex()
    {
        $sitemaps = [];

        foreach ([
            ["", "base", ""],
            ["", "spices", ""],
            ...Sitemapper::contents(),
        ] as $map) {
            $lastUpdated = filemtime("./public/sitemap/{$map[1]}.xml");
            assert($lastUpdated);

            $sitemap = new Sitemap(url("/sitemap/{$map[1]}.xml"));
            $sitemaps[] = $sitemap->withLastModified((new DateTime())->setTimestamp($lastUpdated));
        }

        Sitemapper::writeSitemapIndex(new SitemapIndex($sitemaps), "./public/sitemap.xml");
    }

    public static function generateContentsSitemap()
    {
        foreach (Sitemapper::contents() as $map) {
            $urls = Sitemapper::contentUrls($map[0], $map[2]);
            Sitemapper::writeSitemap($urls, "./public/sitemap/{$map[1]}.xml");
        }
    }

    public static function generateSpicesSitemap()
    {
        $spiceUrls = Sitemapper::spiceUrls();
        Sitemapper::writeSitemap($spiceUrls, "./public/sitemap/spices.xml");
    }

    public static function writeSitemap(UrlSetInterface $urlSet, string $uri)
    {
        $urlWriter = new UrlWriter();
        $xmlWriter = new XMLWriter();

        $xmlWriter->openUri($uri);
        $xmlWriter->startDocument('1.0', 'UTF-8');

        $xmlWriter->startElement('urlset');

        $xmlWriter->writeAttribute(UrlSetInterface::XML_NAMESPACE_ATTRIBUTE, UrlSetInterface::XML_NAMESPACE_URI);
        $xmlWriter->writeAttribute(ImageInterface::XML_NAMESPACE_ATTRIBUTE, ImageInterface::XML_NAMESPACE_URI);
        $xmlWriter->writeAttribute(NewsInterface::XML_NAMESPACE_ATTRIBUTE, NewsInterface::XML_NAMESPACE_URI);
        $xmlWriter->writeAttribute(VideoInterface::XML_NAMESPACE_ATTRIBUTE, VideoInterface::XML_NAMESPACE_URI);
        foreach ($urlSet->urls() as $url) {
            $urlWriter->write($url, $xmlWriter);
        }

        $xmlWriter->endElement();

        $xmlWriter->endDocument();

        return $xmlWriter->outputMemory();
    }

    public static function writeSitemapIndex(SitemapIndex $index, string $uri)
    {
        $sitemapWriter = new SitemapWriter();
        $xmlWriter = new XMLWriter();

        $xmlWriter->openUri($uri);
        $xmlWriter->startDocument('1.0', 'UTF-8');

        $xmlWriter->startElement('sitemapindex');
        $xmlWriter->writeAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');

        foreach ($index->sitemaps() as $sitemap) {
            $sitemapWriter->write($sitemap, $xmlWriter);
        }

        $xmlWriter->endElement();

        $xmlWriter->endDocument();

        return $xmlWriter->outputMemory();
    }
}
