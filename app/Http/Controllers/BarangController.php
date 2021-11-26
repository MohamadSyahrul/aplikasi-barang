<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $index = Barang::all();

        return view('data-barang', [
            'index' => $index
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $price = 19000;
        if($price > 40000) {
            return $price = (10/100) * $price;
          }
        elseif(($price > 20000 ) && ($price  < 40000)){
            return $price = (5/100) * $price;
        }
        else{
            return $price = 0;   
        }        
        dd($price);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $br = new Barang;
        $br->nama_b = $request->nama_b;
        $br->kategori = $request->kategori;
        $br->harga = $request->harga;
        
        if ($request->hasFile('foto_b')) {
            $nm = $request->foto_b;
            $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
            $br->foto_b = $namaFile;
            $nm->move(public_path() . '/img', $namaFile);
        }else{
            $br->foto_b = 'default.png';
        }
        $br->save();
        return redirect()->route('data-barang.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function show(Barang $barang)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $update = Barang::findorfail($id);

        $update->nama_b = $request->nama_b;
        $update->kategori = $request->kategori;
        $update->harga = $request->harga;
        
        if ($request->hasFile('foto_b')) {
            $nm = $request->foto_b;
            $namaFile = time() . rand(100, 999) . "." . $nm->getClientOriginalExtension();
            $update->foto_b = $namaFile;
            $nm->move(public_path() . '/img', $namaFile);
        }else{
            $update->foto_b = 'default.png';
        }

        $update->update();
        return redirect()->route('data-barang.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Barang  $barang
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = Barang::findOrFail($id);

        $file = public_path('/img/').$delete->foto_b;
        if (file_exists($file)){
            @unlink($file);
        }
        $delete->delete();
        return back();
    }
}
