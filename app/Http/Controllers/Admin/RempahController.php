<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Rempah;

use App\Models\Artikel;
use App\Models\ArtikelRempah;
use App\Models\Audio;
use App\Models\Foto;
use App\Models\Kegiatan;
use App\Models\Kerjasama;
use App\Models\Publikasi;
use App\Models\Video;

use Alert;

class RempahController extends Controller
{
    public function index()
    {
        $rempah = Rempah::all();

        return view('admin.master.rempah.index', compact('rempah'));
    }

    public function add()
    {
        return view('admin.master.rempah.add');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nama_rempah' => 'required',
            'keterangan_rempah' => 'required',
        ]);  

        Rempah::create([
            'jenis_rempah' => $request->nama_rempah,
            'keterangan' => $request->keterangan_rempah,
            'jenis_rempah_english' => $request->nama_rempah_english,
            'keterangan_english' => $request->keterangan_rempah_english,
        ]);

        Alert::success('Berhasil', 'Rempah berhasil ditambah');

        return redirect()->route('admin.rempah.index');
    }

    public function edit($rempahId)
    {
        $rempah = Rempah::findOrFail($rempahId);

        return view('admin.master.rempah.edit', compact('rempah'));   
    }

    public function update(Request $request, $rempahId)
    {
       $this->validate($request, [
            'nama_rempah' => 'required',
            'keterangan_rempah' => 'required',
        ]); 
        
        $rempah = Rempah::findOrFail($rempahId);
        $rempah->update([
            'jenis_rempah' =>  $request->nama_rempah,
            'keterangan' => $request->keterangan_rempah,
            'jenis_rempah_english' =>  $request->nama_rempah_english,
            'keterangan_english' => $request->keterangan_rempah_english
        ]);

        Alert::success('Berhasil', 'Rempah berhasil diedit');

        return redirect()->route('admin.rempah.index');
    }

    public function delete(Request $request, $rempahId)
    {
        $rempah = Rempah::findOrFail($rempahId);

        $artikel_rempah = ArtikelRempah::where('id_rempah', $rempah->id)->first();

        if( !$artikel_rempah ) {
            $rempah->delete();
        } else {
            $request->session()->flash('message', 'rempah tidak bisa dihapus karena memiliki relasi dengan konten di jalur rempah');
        }
        // $artikel = Artikel::where('id_kontributor', $rempah->id)->first();
        // $audio = Audio::where('id_kontributor', $rempah->id)->first();
        // $foto = Foto::where('id_kontributor', $rempah->id)->first();
        // $kegiatan = Kegiatan::where('id_kontributor', $rempah->id)->first();
        // $kerjasama = Kerjasama::where('id_kontributor', $rempah->id)->first();
        // $publikasi = Publikasi::where('id_kontributor', $rempah->id)->first();
        // $video = Video::where('id_kontributor', $rempah->id)->first();

        // if( is_null($artikel) && is_null($audio) && is_null($foto) && is_null($kegiatan) && is_null($kerjasama) && is_null($publikasi) && is_null($publikasi) && is_null($video) ) {
        //     $rempah->delete();
        // } else {
        //     $request->session()->flash('message', 'rempah tidak bisa dihapus karena memiliki relasi dengan konten di jalur rempah');
        // }
        
        return redirect()->route('admin.rempah.index'); 
    }
}
