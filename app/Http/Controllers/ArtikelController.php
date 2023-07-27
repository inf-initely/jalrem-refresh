<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

use App\Models\Artikel;
use Illuminate\Pagination\Paginator;

use Auth;

use Carbon\Carbon;

class ArtikelController extends Controller
{

    public function index(Request $request){
        $page = (int)$request->query("page");
        if($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $articles = Artikel::getPage($isApi ? $page : 1, $lang);
        $data = $articles->map(function ($article) use ($lang) {
            $categories = $article->kategori_show->map(function ($category) {
                return $category->isi;
            });

            return [
                "title" => $article->{'judul_'.$lang},
                "thumbnail" => $article->thumbnail,
                "categories" => $categories,
                "slug" => $article->{'slug_'.$lang},
                "author" => $article->penulis != 'admin' ? $article->kontributor_relasi->nama : "admin",
                "published_at" => Carbon::parse($article->published_at)->isoFormat("D MMMM Y")
            ];
        });

        if(!$isApi) {
            return view('content.articles', compact('data'));
        }

        return response()->json([
            "data" => $data
        ]);
    }

    public function index_english(){

        if( Session::get('lg') != 'en' ) {
            return redirect()->route('articles');
        }

        $artikel = Artikel::where('status', 'publikasi')->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'desc');

        $artikel = $artikel->where('judul_english', '!=', null)->paginate(9);
        if( Paginator::resolveCurrentPage() != 1 ) {
            $artikels = [];
            $i = 0;

            if(!request()->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $artikels
                ]);
            }

            foreach( $artikel as $a ) {
                $artikels[$i]['judul'] = $a->judul_english;
                $artikels[$i]['thumbnail'] = $a->thumbnail;
                $j = 0;
                foreach( $a->kategori_show as $ks ) {
                    $artikels[$i]['kategori_show'][$j] = $ks->isi;
                    $j++;
                }
                $artikels[$i]['konten'] = Str::limit($a->konten_english, 50, $end='...');
                $artikels[$i]['slug'] = $a->slug_english ?? $a->slug;
                $artikels[$i]['penulis'] = $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin';
                $artikels[$i]['published_at'] = \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y');
                $i++;
            }

            return response()->json([
                'status' => 'success',
                'data' => $artikels
            ]);
        } else {
            return view('content_english.articles', compact('artikel'));
        }
    }


    public function show(Request $request, $slug)
    {
        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';
        $query_without_this_article = Artikel::where('published_at', '<=', Carbon::now())->where('status', 'publikasi')->orderBy('published_at', 'desc');
        $query_this_article = Artikel::where('slug', $slug)->orWhere('slug_english', $slug)->where('published_at', '<=', Carbon::now())->where('status', 'publikasi');

        $artikel = $query_this_article->firstOrFail();

        // check draft
        if( $artikel->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }

        views($artikel)->record();


        $artikelPopuler = $this->generate_articles_show($query_without_this_article->get());
        $artikelTerbaru = $query_without_this_article->orderBy('published_at')->take(3)->get();

        $artikelTerkait = $this->generate_articles_show($query_without_this_article->get());
        $artikelBacaJuga = $this->generate_articles_show($query_without_this_article->get(), false);

        // if( count($query_without_this_article->get()) > 3 ) {
        //     $artikelPopuler = $artikelPopuler->take(3)->get();
        //     $artikelTerkait = $artikelTerkait->take(3)->get();
        //     $artikelTerbaru = $artikelTerbaru->take(3)->get();

        //     $artikelBacaJuga = $artikelBacaJuga->first();
        // } else {
        //     $artikelPopuler = $artikelPopuler->get();
        //     $artikelTerkait = $artikelTerkait->get();
        //     $artikelTerbaru = $artikelTerbaru->get();
        //     $artikelBacaJuga = $artikelBacaJuga->first();
        // }

        return view('content.article_detail', compact('artikel', 'artikelTerbaru', 'artikelPopuler', 'artikelBacaJuga', 'artikelTerkait'));
    }

    public function show_english(Request $request, $slug)
    {
        if( Session::get('lg') != 'en' ) {
            return redirect()->route('article_detail', $slug);
        }
        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';
        $query_without_this_article = Artikel::where('published_at', '<=', Carbon::now())->where('status', 'publikasi')->orderBy('published_at', 'desc');
        $query_this_article = Artikel::where('slug', $slug)->orWhere('slug_english', $slug)->where('published_at', '<=', Carbon::now())->where('status', 'publikasi');

        $artikel = $query_this_article->firstOrFail();

        // check draft
        if( $artikel->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }

        views($artikel)->record();

        $artikelPopuler = $this->generate_articles_show($artikel->where('judul_english', '!=', null)->get());

        $artikelTerbaru = $query_without_this_article->orderBy('published_at')->take(3)->get();
        $artikelTerkait = $this->generate_articles_show($artikel->where('judul_english', '!=', null)->get());
        $artikelBacaJuga = $this->generate_articles_show($artikel->where('judul_english', '!=', null)->get(), false);

        return view('content.article_detail', compact('artikel', 'artikelTerbaru', 'artikelPopuler', 'artikelBacaJuga', 'artikelTerkait'));
    }

    public function search(Request $request)
    {
        $search = $request->get('search');

        if(Session::get('lg') == 'en' ) {

            $artikel = Artikel::when($search != null, function($query) use ($search) {
                $query->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_english', 'LIKE', '%'.$search . '%')->where('published_at', '<=', Carbon::now());
            })->where('judul_english', '!=', null)->paginate(9);

            return view('content_english.articles', compact('artikel'));
        }

        $artikel = Artikel::when($search != null, function($query) use ($search) {
            $query->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_english', 'LIKE', '%'.$search . '%')->where('published_at', '<=', Carbon::now());
        })->paginate(9);

        return view('content.articles', compact('artikel'));
    }

    private function generate_articles_show($artikel, $is_all = true)
    {
        if( $is_all ) {
            $articles = [];
            $index_container = [];
            $i = 0;
            if( count($artikel) > 1  ) {
                while( $i < 3 ) {

                    // dd(!in_array($index, $index_container));
                    $index = rand(1, count($artikel)) - 1;
                    if( !in_array($index, $index_container) ) {
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
