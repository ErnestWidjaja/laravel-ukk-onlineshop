<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $cari = $request->search;
        $kat = $request->kat;
        if ($cari && $kat == '') {
            $index = DB::table('items')->where('nama_barang','like','%'.$cari.'%')->get();
            $cek = DB::table('items')->where('nama_barang','like','%'.$cari.'%')->count();
        }elseif($kat){
            $index = DB::table('items')->where('kategori_barang',$kat)->where('nama_barang','like','%'.$cari.'%')->get();
            $cek = DB::table('items')->where('kategori_barang',$kat)->where('nama_barang','like','%'.$cari.'%')->count();
        }elseif($cari && $kat){
            $index = DB::table('items')->where('kategori_barang','like','%'.$kat.'%')->get();
            $cek = DB::table('items')->where('kategori_barang','like','%'.$kat.'%')->count();
        }else{
            $index = DB::table('items')->get();
            $cek = DB::table('items')->count();
        }
        $kategori = DB::table('categories')
                    ->orderBy('categories.kategori','ASC')
                    ->get();
        return view('home',compact('index','kategori','cek'));
    }

    public function detail($id)
    {
        $data1 = DB::table('items')->where('id',$id)->first();
        $data2 = DB::table('carts')->where('id_barang',$id)->where('id_user',Auth::user()->id)->first();
        $data = array($data1,$data2);
        return response()->json($data);
    }

    public function stores(Request $request)
    {
        $data = [
        'jumlah' => $request->jumlah,
        'subtotal' => $request->subtotal,
        ];

        $cek = DB::table('carts')->where('id_barang',$request->id_barang)->where('id_user',Auth::user()->id)->count();
        if ($cek >= 1) {
            DB::table('carts')->where('id_barang',$request->id_barang)->where('id_user',Auth::user()->id)->update($data);
        }else{
            DB::table('carts')->insert([
            'id_barang' => $request->id_barang,
            'jumlah' => $request->jumlah,
            'subtotal' => $request->subtotal,
            'id_user' => Auth::user()->id,
            ]);
        }
        // DB::table('items')->where('id',$request->id_barang)->decrement('stok_barang',$request->jumlah);
        return redirect('admin/barang');
    }

    public function autocomplete()
    {
        $data = DB::table('items')->select('nama_barang')->get();
        return response()->json($data);
    }

}
