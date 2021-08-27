<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Pagination\paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;

use App\Models\Artikel;
use App\Models\Publikasi;
use App\Models\Kegiatan;
use App\Models\Kerjasama;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->get('search');

        $search_condition = ($search != null);
        $lg = (Session::get('lg') == 'en') ? 'english' : 'indo';

        $artikel = Artikel::when($search_condition, function($query) use ($search, $lg) {
            $query->where('status', 'publikasi')->orderBy('created_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->get();
        $publikasi = Publikasi::when($search_condition, function($query) use ($search, $lg) {
            $query->where('status', 'publikasi')->orderBy('created_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->get();
        $kegiatan = Kegiatan::when($search_condition, function($query) use ($search, $lg) {
            $query->where('status', 'publikasi')->orderBy('created_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->get();
        $kerjasama = Kerjasama::when($search_condition, function($query) use ($search, $lg) {
            $query->where('status', 'publikasi')->orderBy('created_at', 'desc')->where('judul_' . $lg , 'LIKE', '%'.$search . '%');
        })->get();

        $artikel = $this->paginate($artikel->merge($publikasi)->merge($kegiatan)->merge($kerjasama), 9);
        $artikel->setPath('cari-artikel?search=' . $search);


        if( Session::get('lg') == 'en' )
            return view('content_english.search_content', compact('artikel'));
    

        return view('content.search_content', compact('artikel'));
    }

    private function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }
}
