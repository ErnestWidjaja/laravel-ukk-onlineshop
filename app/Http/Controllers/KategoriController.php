<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class KategoriController extends Controller
{
    public function index()
    {
    	$index = DB::table('categories')->get();
    	return view('admin/kategori',compact('index'));
    }

    public function edit($id)
    {
    	$data = DB::table('categories')->where('id',$id)->first();
        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
    	$data = [
        'kategori' => $request->category
        ];

        $product = DB::table('categories')->where('id',$id)->update($data);
        return response()->json($product);
    }

    public function hapus($id)
    {
    	DB::table('categories')->where('id',$id)->delete();
    	return redirect('admin/kategori');
    }

    public function stores(Request $request)
    {
    	DB::table('categories')->insert([
		'kategori' => $request->category
		]);
		return redirect('admin/kategori');
    }
}
