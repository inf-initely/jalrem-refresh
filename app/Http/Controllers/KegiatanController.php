<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

use Carbon\Carbon;
use Illuminate\Pagination\Paginator;

use App\Models\Kegiatan;

class KegiatanController extends Controller
{
    public function index(Request $request)
    {
        $page = (int)$request->query("page");
        if($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $events = Kegiatan::getPage($isApi ? $page : 1, $lang);
        $data = $events->map(function ($event) use ($lang) {
            $categories = $event->kategori_show->map(function ($category) {
                return $category->isi;
            });

            return [
                "title" => $event->{'judul_'.$lang},
                "thumbnail" => $event->thumbnail,
                "categories" => $categories,
                "slug" => $event->{'slug_'.$lang},
                "author" => $event->penulis != 'admin' ? $event->kontributor_relasi->nama : "admin",
                "published_at" => Carbon::parse($event->published_at)->isoFormat("D MMMM Y")
            ];
        });

        if(!$isApi) {
            return view('content.events', compact('data'));
        }

        return response()->json([
            "data" => $data
        ]);
    }

    public function index_english()
    {
        if( Session::get('lg') != 'en' ) {
            return redirect()->route('events');
        }
        $kegiatan = Kegiatan::where('status', 'publikasi')->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'desc');

        $kegiatan = $kegiatan->where('judul_english', '!=', null)->paginate(9);

        if( Paginator::resolveCurrentPage() != 1 ) {
            $events = [];
            $i = 0;

            if(!request()->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $events
                ]);
            }

            foreach( $kegiatan as $a ) {
                $events[$i]['judul'] = Session::get('lg') == 'en' ? $a->judul_english : $a->judul_indo;
                $events[$i]['thumbnail'] = $a->thumbnail;
                $j = 0;
                foreach( $a->kategori_show as $ks ) {
                    $events[$i]['kategori_show'][$j] = $ks->isi;
                    $j++;
                }
                $events[$i]['konten'] = Session::get('lg') == 'en' ? Str::limit($a->konten_english, 50, $end='...') : Str::limit($a->konten_indo, 50, $end='...');
                $events[$i]['slug'] = $a->slug;
                $events[$i]['penulis'] = $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin';
                $events[$i]['published_at'] = \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y');
                $i++;
            }
            return response()->json([
                'status' => 'success',
                'data' => $events
            ]);
        } else {
            return view('content_english.kegiatan', compact('kegiatan'));
        }

    }

    public function show($slug)
    {
        $lg = Session::get('lg');

        if( $lg == 'en' )
            return redirect()->route('event_detail.english', $slug);

        $kegiatan = Kegiatan::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        // check draft
        if( $kegiatan->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }

        $kegiatanSaatIni = Kegiatan::where('status', 'publikasi')->take(3)->get();

        if( $lg == 'en' )
            return view('content_english.kegiatan_detail', compact('kegiatan', 'kegiatanSaatIni'));

        return view('content.kegiatan_detail', compact('kegiatan', 'kegiatanSaatIni'));
    }

    public function show_english($slug)
    {
        $lg = Session::get('lg');
        if( $lg != 'en' )
            return redirect()->route('event_detail', $slug);

        $kegiatan = Kegiatan::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        // check draft
        if( $kegiatan->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }

        $kegiatanSaatIni = Kegiatan::where('status', 'publikasi')->take(3)->get();

        return view('content_english.kegiatan_detail', compact('kegiatan', 'kegiatanSaatIni'));

    }
}
