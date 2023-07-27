<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Carbon\Carbon;

use Illuminate\Pagination\Paginator;

use App\Models\Publikasi;

class PublikasiController extends Controller
{
    public function index(Request $request)
    {
        $page = (int)$request->query("page");
        if ($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $publications = Publikasi::getPage($isApi ? $page : 1, $lang);
        $data = $publications->map(function ($publication) use ($lang) {
            $categories = $publication->kategori_show->map(function ($publication) {
                return $publication->isi;
            });

            return [
                "title" => $publication->{'judul_' . $lang},
                "thumbnail" => $publication->thumbnail,
                "categories" => $categories,
                "slug" => $publication->{'slug_' . $lang},
                "author" => $publication->penulis != 'admin' ? $publication->kontributor_relasi->nama : "admin",
                "published_at" => Carbon::parse($publication->published_at)->isoFormat("D MMMM Y")
            ];
        });

        if (!$isApi) {
            return view('content.publications', compact('data'));
        }

        return response()->json([
            "data" => $data
        ]);
    }

    public function index_english()
    {
        if (Session::get('lg') != 'en') {
            return redirect()->route('publications');
        }
        $publikasi = Publikasi::where('status', 'publikasi')->where('published_at', '<=', \Carbon\Carbon::now());

        $publikasi = $publikasi->where('judul_english', '!=', null)->orderBy('published_at', 'desc')->paginate(9);

        if (Paginator::resolveCurrentPage() != 1) {
            $publications = [];
            $i = 0;

            if (!request()->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $publications,
                ]);
            }

            foreach ($publikasi as $a) {
                $publications[$i]['judul'] = $a->judul_english;
                $publications[$i]['thumbnail'] = $a->thumbnail;
                $j = 0;
                foreach ($a->kategori_show as $ks) {
                    $publications[$i]['kategori_show'][$j] = $ks->isi;
                    $j++;
                }
                $publications[$i]['konten'] = Str::limit($a->konten_english, 50, $end = '...');
                $publications[$i]['slug'] = $a->slug;
                $publications[$i]['penulis'] = $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin';
                $publications[$i]['published_at'] = \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y');
                $i++;
            }
            return response()->json([
                'status' => 'success',
                'data' => $publications
            ]);
        } else {
            return view('content_english.publications', compact('publikasi'));
        }
    }

    public function show($slug)
    {
        $lg = Session::get('lg');
        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';
        $query_without_this_publication = Publikasi::where('status', 'publikasi');
        $query_this_publication = Publikasi::where('slug', $slug)->orWhere('slug_english', $slug)->where('status', 'publikasi');

        $publikasi = $query_this_publication->firstOrFail();

        views($publikasi)->record();
        $publikasiPopuler = $query_without_this_publication->orderByViews();
        $publikasiTerbaru = $query_without_this_publication->orderBy('published_at', 'desc');
        $publikasiTerkait = $query_without_this_publication;
        $publikasiBacaJuga = $query_without_this_publication;

        $publikasi = Publikasi::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        // check draft
        if ($publikasi->status == 'draft' && !isset(auth()->user()->id)) {
            abort(404);
        }

        views($publikasi)->record();

        $artikelPopuler = $this->generate_articles_show($query_without_this_publication->get());
        $artikelTerbaru = $query_without_this_publication->orderBy('published_at')->take(3)->get();
        $artikelTerkait = $this->generate_articles_show($query_without_this_publication->get());
        $artikelBacaJuga = $this->generate_articles_show($query_without_this_publication->get(), false);

        return view('content.publication_detail', compact('publikasi', 'publikasiPopuler', 'publikasiTerbaru', 'publikasiTerkait', 'publikasiBacaJuga'));
    }

    public function show_english($slug)
    {
        $lg = Session::get('lg');
        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';
        $query_without_this_publication = Publikasi::where('status', 'publikasi');
        $query_this_publication = Publikasi::where('slug', $slug)->orWhere('slug_english', $slug)->where('status', 'publikasi');

        $publikasi = $query_this_publication->firstOrFail();

        views($publikasi)->record();
        $publikasiPopuler = $query_without_this_publication->orderByViews();
        $publikasiTerbaru = $query_without_this_publication->orderBy('published_at', 'desc');
        $publikasiTerkait = $query_without_this_publication;
        $publikasiBacaJuga = $query_without_this_publication;

        $publikasi = Publikasi::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        // check draft
        if ($publikasi->status == 'draft' && !isset(auth()->user()->id)) {
            abort(404);
        }

        views($publikasi)->record();

        $publikasiPopuler = $this->generate_articles_show($publikasi->where('judul_english', '!=', null)->get());
        $publikasiTerbaru = $query_without_this_publication->orderBy('published_at')->take(3)->get();
        $publikasiTerkait = $this->generate_articles_show($publikasi->where('judul_english', '!=', null)->get());
        $publikasiBacaJuga = $this->generate_articles_show($publikasi->where('judul_english', '!=', null)->get(), false);

        return view('content_english.publication_detail', compact('publikasi', 'publikasiPopuler', 'publikasiTerbaru', 'publikasiTerkait', 'publikasiBacaJuga'));
    }

    private function generate_articles_show($artikel, $is_all = true)
    {
        // dd($artikel);
        if ($is_all) {
            $articles = [];
            $index_container = [];
            $i = 0;
            if (count($artikel) > 3) {
                while ($i < 3) {

                    // dd(!in_array($index, $index_container));
                    $index = rand(1, count($artikel)) - 1;
                    if (!in_array($index, $index_container)) {
                        $i++;
                        // dump($i);
                        $articles[] = $artikel[$index];
                        $index_container[] = $index;
                    }
                }
            } else {
                $articles = $artikel;
            }

            // dd('oke');
            return $articles;
        } else {
            $index = rand(1, count($artikel)) - 1;
            return $artikel[$index];
        }
    }
}
