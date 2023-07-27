<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

use App\Models\Foto;
use Illuminate\Pagination\Paginator;

use Carbon\Carbon;

class FotoController extends Controller
{
    public function index(Request $request)
    {
        $page = (int)$request->query("page");
        if($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $photos = Foto::getPage($isApi ? $page : 1, $lang);
        $data = $photos->map(function ($photo) use ($lang) {
            $categories = $photo->kategori_show->map(function ($photo) {
                return $photo->isi;
            });

            return [
                "title" => $photo->{'judul_'.$lang},
                "thumbnail" => $photo->thumbnail,
                "categories" => $categories,
                "slug" => $photo->{'slug_'.$lang},
                "author" => $photo->penulis != 'admin' ? $photo->kontributor_relasi->nama : "admin",
                "published_at" => Carbon::parse($photo->published_at)->isoFormat("D MMMM Y")
            ];
        });

        if(!$isApi) {
            return view('content.photos', compact('data'));
        }

        return response()->json([
            "data" => $data
        ]);
    }

    public function show($slug)
    {
        $lg = Session::get('lg');

        $foto = Foto::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        if( $lg == 'en' )
            return redirect()->route('photo_detail.english', $slug);

        // check draft
        if( $foto->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }

        if( $lg == 'en' )
            return view('content_english.photo_detail', compact('foto'));

        return view('content.photo_detail', compact('foto'));
    }

    public function show_english($slug)
    {
        $lg = Session::get('lg');

        $foto = Foto::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        if( $lg != 'en' )
            return redirect()->route('photo_detail', $slug);

        // check draft
        if( $foto->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }

        if( $lg == 'en' )
            return view('content_english.photo_detail', compact('foto'));

        return view('content.photo_detail', compact('foto'));
    }

}
