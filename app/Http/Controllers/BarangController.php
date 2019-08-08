<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BarangController extends Controller
{
    public function index()
    {
    	$kategori = DB::table('categories')->get();
    	$index = DB::table('items')
    			->select('items.*','categories.kategori')
                ->join('categories','items.kategori_barang','=','categories.id')
                ->get();    	
        return view('admin/barang',compact('index','kategori'));
    }

    public function stores(Request $request)
    {
    	DB::table('items')->insert([
		'kategori_barang' => $request->category,
		'nama_barang' => $request->name,
		'harga_barang' => $request->price,
		'stok_barang' => $request->stock,
		'deskripsi' => $request->description,
        'foto'  => $request->foto
		]);
		return redirect('admin/barang');
    }

    public function edit($id)
    {
    	$data = DB::table('items')->where('id',$id)->first();
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
    	$data = [
        'nama_barang' => $request->name,
        'kategori_barang' => $request->category,
        'harga_barang' => $request->price,
        'stok_barang' => $request->stock,
        'deskripsi' => $request->description,
        'foto' => $request->foto
        ];

        $product = DB::table('items')->where('id',$id)->update($data);
        return response()->json($product);
    }

    public function hapus($id)
    {
    	DB::table('items')->where('id',$id)->delete();
    	return redirect('admin/barang');
    }
}
