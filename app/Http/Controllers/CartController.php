<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class CartController extends Controller
{
    public function index()
    {
    	$index = DB::table('carts')
                ->join('items','items.id','=','carts.id_barang')
                ->join('users','users.id','=','carts.id_user')
                ->select('carts.id as id_cart','items.*','carts.*','users.*')
                ->where('id_user',Auth::user()->id)
                ->get();    
        $cek = DB::table('carts')
                ->join('items','items.id','=','carts.id_barang')
                ->join('users','users.id','=','carts.id_user')
                ->select('carts.id as id_cart','items.*','carts.*','users.*')
                ->where('id_user',Auth::user()->id)
                ->count();    	
        return view('customer/cart',compact('index','cek'));
    }

    public function hapus($id)
    {
    	DB::table('carts')->where('carts.id',$id)->delete();
    	return redirect('/cart');
    }

    public function process()
    {
        $index = DB::table('carts')
                ->join('items','items.id','=','carts.id_barang')
                ->join('users','users.id','=','carts.id_user')
                ->select('carts.id as id_cart','items.*','carts.*','users.*')
                ->where('id_user',Auth::user()->id)
                ->get();
        $id = Auth::user()->id;
        $user = DB::table('users')->where('id',Auth::user()->id)->get(); 
        return view('customer/process',compact('index','user'));
    }
}
