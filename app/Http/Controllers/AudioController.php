<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;

use App\Models\Audio;

use Carbon\Carbon;

class AudioController extends Controller
{
    public function index(Request $request)
    {
        $page = (int)$request->query("page");
        if($page < -1) {
            return response("parameter page should be an unsigned int", Response::HTTP_BAD_REQUEST);
        }

        $isApi = $page !== 0;

        $lang = App::getLocale();
        $audios = Audio::getPage($isApi ? $page : 1, $lang);
        $data = $audios->map(function ($audio) use ($lang) {
            $categories = $audio->kategori_show->map(function ($category) {
                return $category->isi;
            });

            return [
                "title" => $audio->{'judul_'.$lang},
                "cloud_key" => $audio->cloud_key,
                "categories" => $categories,
                "slug" => $audio->{'slug_'.$lang}
            ];
        });

        if(!$isApi) {
            return view('content.audios', compact('data'));
        }

        return response()->json([
            "data" => $data
        ]);
    }

    public function index_english()
    {
        if (Session::get('lg') != 'en') {
            return redirect()->route('audios');
        }

        $audio = Audio::where('status', 'publikasi')->where('published_at', '<=', Carbon::now())->orderBy('published_at', 'desc');

        $audio = $audio->where('judul_english', '!=', null)->paginate(1);
        if (Paginator::resolveCurrentPage() != 1) {
            $audios = [];
            $i = 0;

            if (!request()->ajax()) {
                return response()->json([
                    'status' => 'success',
                    'data' => $audios,
                ]);
            }

            foreach ($audio as $a) {
                $audios[$i]['judul'] = Session::get('lg') == 'en' ? $a->judul_english : $a->judul_indo;
                $audios[$i]['cloudkey'] = $a->cloud_key;
                $audios[$i]['slug'] = $a->slug_english ?? $a->slug;
                $audios[$i]['konten'] = Session::get('lg') == 'en' ? Str::limit($a->konten_english, 50, $end = '...') : Str::limit($a->konten_indo, 50, $end = '...');
                $j = 0;
                foreach ($a->kategori_show as $ks) {
                    $audios[$i]['kategori_show'][$j] = $ks->isi;
                    $j++;
                }
                $audios[$i]['published_at'] = Carbon::parse($a->published_at)->diffForHumans();
                $i++;
            }
            return response()->json([
                'status' => 'success',
                'data' => $audios
            ]);
        } else {
            return view('content_english.audios', compact('audio'));
        }
    }

    public function show($slug)
    {
        $lg = Session::get('lg');

        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';

        $audio = Audio::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        if ($lg == 'en') {
            return redirect()->route('audio_detail.english', $audio->slug_english);
        }
        // check draft
        if ($audio->status == 'draft' && !isset(auth()->user()->id)) {
            abort(404);
        }

        return view('content.audio_detail', compact('audio'));
    }

    public function show_english($slug)
    {
        $lg = Session::get('lg');
        if ($lg != 'en') {
            return redirect()->route('audio_detail', $slug);
        }
        // $slug_field = $lg == 'en' ? 'slug_english' : 'slug';

        $audio = Audio::where('slug', $slug)->orWhere('slug_english', $slug)->firstOrFail();

        // check draft
        if ($audio->status == 'draft' && !isset(auth()->user()->id)) {
            abort(404);
        }

        if ($lg == 'en') {
            return view('content_english.audio_detail', compact('audio'));
        }

        return view('content.audio_detail', compact('audio'));
    }
}
