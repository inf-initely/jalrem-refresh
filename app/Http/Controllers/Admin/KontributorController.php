<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Kontributor;
use App\Models\Lokasi;

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
    //    $this->validate($request, [
    //         'nama_rempah' => 'required',
    //         'keterangan_rempah' => 'required'
    //     ]); 
        
        $kontributor = Kontributor::findOrFail($kontributorId);
        $kontributor->update([
            'nama' => $request->nama_penulis,
            'email' => $request->email,
            'domisili' => $request->domisili,
            'atribusi' => $request->atribusi,
            'kategori' => $request->kategori,
        ]);

        return redirect()->route('admin.contributor.index');
    }

    public function delete($kontributorId)
    {
        $kontributor = Kontributor::findOrFail($kontributorId);
        $kontributor->delete();
        
        return redirect()->route('admin.rempah.index'); 
    }
}
