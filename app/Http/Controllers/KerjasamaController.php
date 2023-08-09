<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use App\Models\Kerjasama;

use Illuminate\Pagination\Paginator;

class KerjasamaController extends Controller
{
    public function index(Request $request)
    {
        $page = (int)$request->query("page");
        if($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $partnerships = Kerjasama::getPageQuery($isApi ? $page : 1, $lang)->get();
        $data = $partnerships->map(function ($partnership) use ($lang) {
            $categories = $partnership->kategori_show->map(function ($category) {
                return $category->isi;
            });

            return [
                "title" => $partnership->{'judul_'.$lang},
                "thumbnail" => $partnership->thumbnail,
                "categories" => $categories,
                "slug" => $partnership->{'slug_'.$lang},
                "author" => $partnership->penulis != 'admin' ? $partnership->kontributor_relasi->nama : "admin",
                "published_at" => Carbon::parse($partnership->published_at)->isoFormat("D MMMM Y")
            ];
        });

        if(!$isApi) {
            return view('content.kerjasama', compact('data'));
        }

        return response()->json([
            "data" => $data
        ]);
    }
    public function show($slug)
    {
        $lg = Session::get('lg');

        $kerjasama = Kerjasama::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        // check draft
        if( $kerjasama->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }

        if( $lg == 'en' )
            return view('content_english.kerjasama_detail', compact('kerjasama'));

        return view('content.kerjasama_detail', compact('kerjasama'));
    }
}
