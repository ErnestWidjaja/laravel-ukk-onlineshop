<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportController extends Controller
{
    public function index()
    {
    	$index = DB::table('transactions')
                ->get();    	
        return view('admin/report',compact('index'));
    }

    public function detail($id)
    {
    	$data = DB::table('transactions')
				->join('item_transactions','item_transactions.id_transaksi','=','transactions.id_transaksi')
				->join('items','item_transactions.id_barang','=','items.id')
				->where('transactions.id_transaksi',$id)
				->get();
		return response()->json($data);
    }
}
