<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kontributor;
use App\Models\Lokasi;

use App\Models\Artikel;
use App\Models\Audio;
use App\Models\Foto;
use App\Models\Kegiatan;
use App\Models\Kerjasama;
use App\Models\Publikasi;
use App\Models\Video;

use Alert;

class KontributorController extends Controller
{
    public function index()
    {
        $kontributor = Kontributor::all();

        return view('admin.master.contributor.index', compact('kontributor'));
    }

    public function add()
    {
        $lokasi = Lokasi::all();

        return view('admin.master.contributor.add', compact('lokasi'));
    }

    public function store(Request $request)
    {
        // $this->validate($request, [
        //     'nama_penulis' => 'required',
        //     'keterangan_rempah' => 'required'
        // ]);  

        Kontributor::create([
            'nama' => $request->nama_penulis,
            'email' => $request->email,
            'domisili' => $request->domisili,
            'atribusi' => $request->atribusi,
            'kategori' => $request->kategori,
        ]);

        Alert::success('Berhasil', 'Kontributor berhasil ditambah');

        return redirect()->route('admin.contributor.index');
    }

    public function edit($kontributorId)
    {
        $kontributor = Kontributor::findOrFail($kontributorId);
        $lokasi = Lokasi::all();

        return view('admin.master.contributor.edit', compact('kontributor', 'lokasi'));   
    }

    public function update(Request $request, $kontributorId)
    {
        $kontributor = Kontributor::findOrFail($kontributorId);
        $kontributor->update([
            'nama' => $request->nama_penulis,
            'email' => $request->email,
            'domisili' => $request->domisili,
            'atribusi' => $request->atribusi,
            'kategori' => $request->kategori,
        ]);

        Alert::success('Berhasil', 'Kontributor berhasil diedit');

        return redirect()->route('admin.contributor.index');
    }

    public function delete(Request $request, $kontributorId)
    {
        $kontributor = Kontributor::findOrFail($kontributorId);

        $artikel = Artikel::where('id_kontributor', $kontributor->id)->first();
        $audio = Audio::where('id_kontributor', $kontributor->id)->first();
        $foto = Foto::where('id_kontributor', $kontributor->id)->first();
        $kegiatan = Kegiatan::where('id_kontributor', $kontributor->id)->first();
        $kerjasama = Kerjasama::where('id_kontributor', $kontributor->id)->first();
        $publikasi = Publikasi::where('id_kontributor', $kontributor->id)->first();
        $video = Video::where('id_kontributor', $kontributor->id)->first();

        if( is_null($artikel) && is_null($audio) && is_null($foto) && is_null($kegiatan) && is_null($kerjasama) && is_null($publikasi) && is_null($publikasi) && is_null($video) ) {
            $kontributor->delete();
        } else {
            $request->session()->flash('message', 'kontributor tidak bisa dihapus karena memiliki konten di jalur rempah');
        }

        return redirect()->route('admin.contributor.index'); 
    }
}
