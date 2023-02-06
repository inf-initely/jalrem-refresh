<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

use App\Models\Artikel;
use App\Models\Foto;
use App\Models\Video;
use App\Models\Audio;
use App\Models\Publikasi;
use App\Models\Kegiatan;
use App\Models\Kerjasama;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        if( Session::get('lg') == 'en' ) {
            return redirect()->route('article_search.english');
        }
        $search = $request->get('search');

        if (!is_string($search)) $search = null;

        $search_condition = ($search != null);
        $lg = 'indo';

        $artikel = Artikel::when($search_condition, function($query) use ($search, $lg) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->when($lg == 'english', function($query) use ($lg, $search) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('judul_english', '!=', null);
        })->get();
        $foto = Foto::when($search_condition, function($query) use ($search, $lg) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->when($lg == 'english', function($query) use ($lg, $search) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('judul_english', '!=', null);
        })->get();
        $audio = Audio::when($search_condition, function($query) use ($search, $lg) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->when($lg == 'english', function($query) use ($lg, $search) {
            $query->where('judul_english', '!=', null);
        })->get();
        $video = Video::when($search_condition, function($query) use ($search, $lg) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->when($lg == 'english', function($query) use ($lg, $search) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('judul_english', '!=', null);
        })->get();
        $publikasi = Publikasi::when($search_condition, function($query) use ($search, $lg) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->when($lg == 'english', function($query) use ($lg, $search) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('judul_english', '!=', null);
        })->get();
        $kegiatan = Kegiatan::when($search_condition, function($query) use ($search, $lg) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->when($lg == 'english', function($query) use ($lg, $search) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('judul_english', '!=', null);
        })->get();
        $kerjasama = Kerjasama::when($search_condition, function($query) use ($search, $lg) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->when($lg == 'english', function($query) use ($lg, $search) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('judul_english', '!=', null);
        })->get();

        $artikel = $this->paginate($artikel->mergeRecursive($publikasi)->mergeRecursive($kegiatan)->mergeRecursive($kerjasama)->mergeRecursive($foto)->mergeRecursive($audio)->mergeRecursive($video), 9);
        $artikel->setPath('cari?search=' . $search);

        return view('content.search_content', compact('artikel'));
    }

    public function search_english(Request $request)
    {
        if( Session::get('lg') != 'en' ) {
            return redirect()->route('article_search');
        }
        $search = $request->get('search');

        if (!is_string($search)) $search = null;

        $search_condition = ($search != null);
        $lg = 'english';

        $artikel = Artikel::when($search_condition, function($query) use ($search, $lg) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->when($lg == 'english', function($query) use ($lg, $search) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('judul_english', '!=', null);
        })->get();
        $foto = Foto::when($search_condition, function($query) use ($search, $lg) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->when($lg == 'english', function($query) use ($lg, $search) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('judul_english', '!=', null);
        })->get();
        $audio = Audio::when($search_condition, function($query) use ($search, $lg) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->when($lg == 'english', function($query) use ($lg, $search) {
            $query->where('judul_english', '!=', null);
        })->get();
        $video = Video::when($search_condition, function($query) use ($search, $lg) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->when($lg == 'english', function($query) use ($lg, $search) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('judul_english', '!=', null);
        })->get();
        $publikasi = Publikasi::when($search_condition, function($query) use ($search, $lg) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->when($lg == 'english', function($query) use ($lg, $search) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('judul_english', '!=', null);
        })->get();
        $kegiatan = Kegiatan::when($search_condition, function($query) use ($search, $lg) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->when($lg == 'english', function($query) use ($lg, $search) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('judul_english', '!=', null);
        })->get();
        $kerjasama = Kerjasama::when($search_condition, function($query) use ($search, $lg) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('status', 'publikasi')->orderBy('published_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->when($lg == 'english', function($query) use ($lg, $search) {
            $query->where('published_at', '<=', \Carbon\Carbon::now())->where('judul_english', '!=', null);
        })->get();

        $artikel = $this->paginate($artikel->mergeRecursive($publikasi)->mergeRecursive($kegiatan)->mergeRecursive($kerjasama)->mergeRecursive($foto)->mergeRecursive($audio)->mergeRecursive($video), 9);
        $artikel->setPath('cari?search=' . $search);


        return view('content_english.search_content', compact('artikel'));
    }

    private function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
