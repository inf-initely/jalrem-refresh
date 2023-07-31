<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;

use Illuminate\Pagination\Paginator;
use Carbon\Carbon;

use App\Models\Video;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $page = (int)$request->query("page");
        if ($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $videos = Video::getPage($isApi ? $page : 1, $lang);
        $data = $videos->map(function ($video) use ($lang) {
            $categories = $video->kategori_show->map(function ($video) {
                return $video->isi;
            });

            return [
                "title" => $video->{'judul_' . $lang},
                "youtube_key" => $video->youtube_key,
                "categories" => $categories,
                "slug" => $video->{'slug_' . $lang}
            ];
        });

        if (!$isApi) {
            return view('content.videos', compact('data'));
        }

        return response()->json([
            "data" => $data
        ]);
    }

    public function index_english()
    {
        if( Session::get('lg') != 'en' )
            return redirect()->route('videos');
        $video = Video::where('status', 'publikasi')->where('published_at', '<=', \Carbon\Carbon::now())->orderBy('published_at', 'desc');

        $video = $video->where('judul_english', '!=', null)->paginate(9);

        if( Paginator::resolveCurrentPage() != 1 ) {
            $videos = [];
            $i = 0;

            if(!request()->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $videos,
                ]);
            }

            foreach( $video as $a ) {
                $videos[$i]['judul'] = $a->judul_english;
                $videos[$i]['youtubekey'] = $a->youtube_key;
                $j = 0;
                foreach( $a->kategori_show as $ks ) {
                    $videos[$i]['kategori_show'][$j] = $ks->isi;
                    $j++;
                }
                $videos[$i]['konten'] = Str::limit($a->konten_english, 50, $end='...');
                $videos[$i]['slug'] = $a->slug;
                $videos[$i]['penulis'] = $a->penulis != 'admin' ? $a->kontributor_relasi->nama : 'admin';
                $videos[$i]['published_at'] = \Carbon\Carbon::parse($a->published_at)->isoFormat('D MMMM Y');
                $i++;
            }
            return response()->json([
                'status' => 'success',
                'data' => $videos
            ]);
        } else {
            return view('content_english.videos', compact('video'));
        }


    }

    public function show($slug)
    {
        $lg = Session::get('lg');
        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';

        $video = Video::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        if( Session::get('lg') == 'en' ) {
            return redirect()->route('video_detail.english', $video->slug_english);
        }

        // check draft
        if( $video->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }

        if( $lg == 'en' ) {
            return view('content_english.video_detail', compact('video'));
        }

        return view('content.video_detail', compact('video'));
    }

    public function show_english($slug)
    {
        $lg = Session::get('lg');
        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';

        $video = Video::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        if( Session::get('lg') != 'en' ) {
            return redirect()->route('video_detail', $video->slug);
        }

        // check draft
        if( $video->status == 'draft' && !isset(auth()->user()->id) ) {
            abort(404);
        }

        if( $lg == 'en' ) {
            return view('content_english.video_detail', compact('video'));
        }

        return view('content.video_detail', compact('video'));
    }
}
