<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

use App\Models\Rempah;

class RempahController extends Controller
{
    public function show($rempahName)
    {
        $rempah = Rempah::where('jenis_rempah', $rempahName)->orWhere('jenis_rempah_english', $rempahName)->firstOrFail();
        $rempahs = Rempah::all();
        $artikel_rempah = $rempah->artikel->filter(function($item) use ($rempah) {
            return ($item->status == 'publikasi'  && $item->published_at <= \Carbon\Carbon::now());
        })->sortByDesc('published_at')->slice(0, 5);

        if( Session::get('lg') == 'en' )
            return view('content_english.rempah_detail', compact('rempah', 'artikel_rempah', 'rempahs'));

        return view('content.rempah_detail', compact('rempah', 'artikel_rempah', 'rempahs'));
    }

    public function getJSON()
    {
        $lg = Session::get('lg');
        $rempah = Rempah::orderBy($lg == 'en' ? 'jenis_rempah_english' : 'jenis_rempah' , 'asc')->get();

        return response()->json($rempah);
    }
}
