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
use DateTime;
use Refinery29\Sitemap\Component\Image\Image;
use Refinery29\Sitemap\Component\News\News;
use Refinery29\Sitemap\Component\News\Publication;
use Refinery29\Sitemap\Component\Sitemap;
use Refinery29\Sitemap\Component\SitemapIndex;
use Refinery29\Sitemap\Component\Url;
use Refinery29\Sitemap\Component\UrlSet;
use Refinery29\Sitemap\Component\UrlSetInterface;
use Refinery29\Sitemap\Writer\SitemapIndexWriter;
use Refinery29\Sitemap\Writer\UrlSetWriter;
use Slainless\Sitemap\Component\Alt;

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

    public static function baseUrls()
    {
        $urls = [];
        foreach ([
            ["home", 1.0],

            ["the-route", 0.9], ["the-trail", 0.9], ["the-future", 0.9],

            ["information", 0.8],

            ["contents", 0.7],  ["articles", 0.7],      ["audios", 0.7],
            ["events", 0.7],    ["photos", 0.7],        ["publications", 0.7],
            ["videos", 0.7],    ["partnerships", 0.7],
        ] as $url) {
            $alts = [
                new Alt(route($url[0].".id"), "id"),
                new Alt(route($url[0].".en"), "en"),
            ];

            foreach (["id", "en"] as $lang) {
                $urls[] = Url::create(route($url[0]."." . $lang))
                    ->withPriority($url[1])
                    ->withAlternatives($alts);
            }
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

            if ($Class == Foto::class) {
                $query->addSelect(
                    "slider_foto",
                    "caption_slider_foto as caption_id",
                    "caption_slider_foto_english as caption_en",
                );
            }
        }

        $urls = [];
        $contents = $query->get();
        foreach ($contents as $content) {
            $alts = [];

            foreach (["id", "en"] as $lang) {
                if ($content->{"slug_" . $lang} != null && $content->{"slug_" . $lang} != "" && $content->{"slug_" . $lang} != "n/a") {
                    $alts[] = new Alt(route($baseRouteName . "." . $lang, $content->{"slug_" . $lang}), $lang);
                }
            }

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

                $url = $url
                    ->withNews([$news])
                    ->withAlternatives($alts);

                if ($type === 3) {
                    $imgs = [];
                    $imgs[] = new Image(asset('storage/assets/' . substr($content->getTable(), 0, -1) . '/thumbnail/' . $content->thumbnail));

                    if ($Class == Foto::class) {
                        $us = unserialize($content->slider_foto);
                        // wtf why does this need to be decoded first!!!
                        $captions = unserialize(json_decode($content->{'caption_' . $lang}));
                        foreach ($us as $i => $u) {
                            $img = new Image(asset('storage/assets/foto/slider_foto/' . $u));
                            if ($captions[$i] != "" && $captions[$i] != null) {
                                $img = $img->withCaption($captions[$i]);
                            }
                            $imgs[] = $img;
                        }
                    }

                    $url = $url->withImages($imgs);
                }

                $urls[] = $url;
            }
        }

        return new UrlSet($urls);
    }

    public static function spiceUrls()
    {
        $urls = [];

        $spices = Rempah::select("jenis_rempah as name_id", "jenis_rempah_english as name_en")->get();
        foreach ($spices as $spice) {
            $alts = [
                new Alt(route("rempah_detail.id", $spice->name_id), "id"),
                new Alt(route("rempah_detail.en", $spice->name_en), "en"),
            ];

            foreach (["id", "en"] as $lang) {
                $urls[] = Url::create(route("rempah_detail." . $lang, $spice->{"name_" . $lang}))
                    ->withPriority(0.6)
                    ->withAlternatives($alts);
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

            $sitemaps[] = Sitemap::create(url("/sitemap/{$map[1]}.xml"))
                ->withLastModified((new DateTime())
                    ->setTimestamp($lastUpdated));
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
        UrlSetWriter::create()->writeToUri($urlSet, $uri);
    }

    public static function writeSitemapIndex(SitemapIndex $index, string $uri)
    {
        SitemapIndexWriter::create()->writeToUri($index, $uri);
    }
}
