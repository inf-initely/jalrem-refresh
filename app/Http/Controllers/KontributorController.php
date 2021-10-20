<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artikel;
use App\Models\Kontributor;
use App\Models\Rempah;
use App\Models\Lokasi;
use App\Models\KategoriShow;

use Alert;

class KontributorController extends Controller
{
    public function index()
    {
        $rempahs = Rempah::all();
        $lokasi = Lokasi::all();
        $kategori_show = KategoriShow::all();
        $kontributor = Kontributor::all();

        return view('content.contributor', compact('rempahs', 'lokasi', 'kategori_show', 'kontributor'));
    }

    public function upload(Request $request)
    {
        $this->validate($request, [
            'judul_indo' => 'required|string',
            'konten_indo' => 'required|string',
            'thumbnail' => 'required|max:10000|mimes:png,jpg,jpeg',
            'penulis' => 'required|string',
            'email' => 'required|email',
            'domisili' => 'required|string',
            'kategori' => 'required|string',
            'captcha' => 'required|captcha'
        ]);

        $judul_indo = $request->judul_indo;
        $konten_indo = $request->konten_indo;
        $thumbnail = $request->thumbnail;

        $penulis = $request->penulis;
        $email = $request->email;
        $domisili = $request->domisili;
        $atribusi = $request->atribusi;
        $kategori = $request->kategori;
        $link = $request->link;

        // UPLOAD THUMBNAIL
        $thumbnail = $request->file('thumbnail');
        $tujuan_upload_file_thumbnail = storage_path('app/public/assets/artikel/thumbnail');
        $filename_thumbnail = uniqid() . '.' . $thumbnail->getClientOriginalExtension();
        $thumbnail->move($tujuan_upload_file_thumbnail, $filename_thumbnail);

        $kontributor = Kontributor::where('email', $email)->first();
        if( !$kontributor ) {
            $kontributor = Kontributor::create([
                'nama' => $penulis,
                'email' => $email,
                'domisili' => $domisili,
                'atribusi' => $atribusi,
                'kategori' => $kategori
            ]);
        }

        $artikel = Artikel::create([
            'judul_indo' => $judul_indo,
            'konten_indo' => $konten_indo,
            'thumbnail' => $filename_thumbnail,
            'penulis' => 'kontributor umum/pamong budaya',
            'id_kontributor' => $kontributor->id,
            'link' => $link,
            'status' => 'draft'
        ]);

        Alert::success('Berhasil', 'Artikel berhasil dikirim');

        return redirect()->route('home');
    }
}
