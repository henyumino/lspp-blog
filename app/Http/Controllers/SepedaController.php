<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sepeda;
use Carbon\Carbon;

class SepedaController extends Controller
{
    public function showSepeda(){
        $data = Sepeda::all();
        return view('pages.sepeda', compact('data'));
    }

    public function addSepeda(){
        return view('pages.addSepeda');
    }

    public function store(Request $request){
        $request->validate([
            'nama_sepeda' => 'required',
            'merk_sepeda' => 'required',
            'jenis_sepeda' => 'required',
            'peruntukan' => 'required',
            'jumlah_speed' => 'required',
            'tanggal_launching' => 'required',
        ]);

        $launch = Carbon::parse($request->tanggal_launching)->format('Y-m-d H:i');

        $sepeda = new Sepeda;
        $sepeda->nama_sepeda = $request->nama_sepeda;
        $sepeda->merk_sepeda = $request->merk_sepeda;
        $sepeda->jenis_sepeda =  $request->jenis_sepeda;
        $sepeda->peruntukan = $request->peruntukan;
        $sepeda->jumlah_speed = $request->jumlah_speed;
        $sepeda->tanggal_launching = $launch;
        $sepeda->save();

        return redirect()->route('sepeda')->with('success', 'berhasil menambah sepeda');

    }

    public function destroy($id){
        Sepeda::destroy($id);

        return redirect()->route('sepeda')->with('success', 'berhasil menghapus sepeda');
    }

    public function edit($id){
        $data = Sepeda::find($id);
        $tgl = Carbon::parse($data->tanggal_launching)->format('d/m/Y H:i');
        return view('pages.editSepeda', compact('data', 'tgl'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama_sepeda' => 'required',
            'merk_sepeda' => 'required',
            'jenis_sepeda' => 'required',
            'peruntukan' => 'required',
            'jumlah_speed' => 'required',
            'tanggal_launching' => 'required',
        ]);
        // $launch = Carbon::createFromFormat('m-d-Y H:i',$request->tanggal_launching)->format('Y-m-d H:i');
        $launch = Carbon::parse($request->tanggal_launching)->format('Y-m-d H:i');
        $sepeda = Sepeda::find($id);
        $sepeda->nama_sepeda = $request->nama_sepeda;
        $sepeda->merk_sepeda = $request->merk_sepeda;
        $sepeda->jenis_sepeda =  $request->jenis_sepeda;
        $sepeda->peruntukan = $request->peruntukan;
        $sepeda->jumlah_speed = $request->jumlah_speed;
        $sepeda->tanggal_launching = $launch;
        $sepeda->save();
        

        return redirect()->route('sepeda')->with('success', 'berhasil mengupdate sepeda');
    }

}
