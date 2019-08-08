<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use File;
use Auth;

class ProfileController extends Controller
{
    public function index()
    {
    	$id = Auth::user()->id;
    	$index = DB::table('users')->get();
    	return view('profile',compact('index'));
    }

    public function edit(Request $request)
    {
    	$data = DB::table('users')->where('id',$request->id)->first();
        return response()->json($data);
    }

    public function update(Request $request)
    {
    	$data = [
        'name' => $request->name,
        'jk' => $request->jk,
        'email' => $request->email,
        'no_tlp' => $request->no_tlp,
        'alamat' => $request->alamat,
        'photo' => $request->photo
        ];

        $product = DB::table('users')->where('id',$request->id)->update($data);
        return response()->json($product);
    }
}
