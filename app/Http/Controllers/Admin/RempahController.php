<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Rempah;

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
            'keterangan_rempah' => 'required'
        ]);  

        Rempah::create([
            'jenis_rempah' => $request->nama_rempah,
            'keterangan' => $request->keterangan_rempah
        ]);

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
            'keterangan_rempah' => 'required'
        ]); 
        
        $rempah = Rempah::findOrFail($rempahId);
        $rempah->update([
            'jenis_rempah' =>  $request->nama_rempah,
            'keterangan' => $request->keterangan_rempah
        ]);

        return redirect()->route('admin.rempah.index');
    }

    public function delete($rempahId)
    {
        $rempah = Rempah::findOrFail($rempahId);
        $rempah->delete();
        
        return redirect()->route('admin.rempah.index'); 
    }
}
