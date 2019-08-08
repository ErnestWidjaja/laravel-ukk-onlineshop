<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

class TransactionController extends Controller
{
	public function index(Request $request)
	{
		$status = $request->status;
		if (Auth::user()->role == 'Administrator' && $status == '') {
			$index = DB::table('transactions')
				->join('item_transactions','item_transactions.id_transaksi','=','transactions.id_transaksi')
				->join('items','item_transactions.id_barang','=','items.id')
				->get();
		}elseif (Auth::user()->role == 'Administrator' && $status) {
			$index = DB::table('transactions')
				->join('item_transactions','item_transactions.id_transaksi','=','transactions.id_transaksi')
				->join('items','item_transactions.id_barang','=','items.id')
				->where('transactions.status',$status)
				->get();
		}elseif($status){
			$index = DB::table('transactions')
				->join('item_transactions','item_transactions.id_transaksi','=','transactions.id_transaksi')
				->join('items','item_transactions.id_barang','=','items.id')
				->where('transactions.id_user',Auth::user()->id)
				->where('transactions.status',$status)
				->get();
		}else{
			$index = DB::table('transactions')
				->join('item_transactions','item_transactions.id_transaksi','=','transactions.id_transaksi')
				->join('items','item_transactions.id_barang','=','items.id')
				->where('transactions.id_user',Auth::user()->id)
				->get();
		}
		
		return view('customer/transaction',compact('index'));
	}

    public function stores(Request $request)
    {

    	DB::table('transactions')->insert([
		'id_transaksi' => $request->id_transaksi,
		'id_user' => Auth::user()->id,
		'penerima' => $request->penerima,
		'no_tlp' => $request->no_tlp,
		'alamat' => $request->alamat,
		'ongkir' => 10000,
		'total' => $request->total,
		'status' => 'Waiting'
		]);

		$data = DB::table('carts')->where('id_user',Auth::user()->id)->get();
    	foreach ($data as $datas) {
		DB::table('item_transactions')->insert([
		'id_transaksi' => $request->id_transaksi,
		'id_barang' => $datas->id_barang,
		'subtotal' => $datas->subtotal,
		'jumlah' => $datas->jumlah
		]);
		DB::table('items')->where('id',$datas->id_barang)->decrement('stok_barang', $datas->jumlah);
		}

		DB::table('carts')->where('id_user',Auth::user()->id)->delete();
		return redirect('/transaction');
    }

    public function accept($id)
    {
    	$data = [
        'status' => 'Sending'
        ];

        $product = DB::table('transactions')->where('id_transaksi',$id)->update($data);
        return redirect('transaction');
    }

    public function received($id)
    {
    	$data = [
        'status' => 'Received'
        ];

        $product = DB::table('transactions')->where('id_transaksi',$id)->update($data);
        return redirect('transaction');
    }
}
