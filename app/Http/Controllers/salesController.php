<?php

namespace App\Http\Controllers;

use App\Sales;
use App\Item;
use App\DetailSales;
use App\Stock;
use App\Owner;
use Auth;

use Illuminate\Http\Request;

class salesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $id_owner = Auth::User()->owner_id;
        $item = Item::all();
        $owner = Owner::where('o_id',$id_owner)->get();
        // $owner = Stock::join('m_owner','s_id_owner','=','o_id')->join('m_item','s_id_item','=','i_id')->get();
        // dd($owner);
        return view('sales.index',compact('item','owner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      // dd($request->all());

      $nom = Sales::max('id');
      $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
      $AWAL = 'BRT';
      $no = 1;
      $no_nota='';
      // dd($nom);

      if($nom) {
        $no_noto = sprintf("%03s", abs($nom + 1)). '/' . $AWAL .'/' . $bulanRomawi[date('n')] .'/' . date('Y');
    }
    else {
       $no_nota = sprintf("%03s", $no). '/' . $AWAL .'/' . $bulanRomawi[date('n')] .'/' . date('Y');
    }


      $sales = new Sales;
      $sales->date = date('Y-m-d');
      $sales->nota = $no_nota;
      $sales->total = array_sum($request->tot);
      $sales->save();

      $last_id=$sales->id;


      $input = $request->all();
      // dd($input);
  for($i=0; $i<= count($input['jumlah']); $i++) {

    if(empty($input['jumlah'][$i]) || !is_numeric($input['jumlah'][$i])) continue;

    $data = [
      'sales_id' => $last_id,
      'detail_id' => $i,
      'item_id' => $input['id_barang'][$i],
      'value' => $input['barang_harga'][$i],
      'qty' => $input['jumlah'][$i],
      'total_net' => $input['tot'][$i]
    ];

    DetailSales::create($data);
    return back();

  }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function show(Sales $sales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function edit(Sales $sales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sales $sales)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Sales  $sales
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sales $sales)
    {
        //
    }
    public function get_data_barang($request)
    {
      $item = Stock::join('m_owner','s_id_owner','=','o_id')
      ->join('m_item','s_id_item','=','i_id')
      ->where('s_id_owner',$request)
      ->get();

      // $item = Item::find($id);
      // dd($item);
      // return response()->json(['item' => $item], 200);
      // return json_encode($item);
      return $item;
    }

    public function get_harga_barang($id)
    {

      $item = Item::where('i_id',$id)->value('i_price');
      // dd($item);
      // return response()->json(['item' => $item], 200);
      return json_encode($item);
      // return $item;
    }

    public function cek_qty($qty)
    {
      $qty = Stock::where('s_id_item',$qty)->value('s_qty');
      return $qty;
    }

    public function kurangi_stock(Request $request)
    {
      $get_item = Stock::where('s_id_item',$request->id_barang)->get();
      $qtyAwal = '';
      $id_item = '';

      foreach ($get_item as $key => $value) {
        $id_item = $value->s_id;
        $qtyAwal = $value->s_qty;
      }

      $qtyTotal = $qtyAwal - (int)$request->qty ;

      $stock = Stock::find($id_item);
      // $stock
      $stock->s_qty = $qtyTotal;
      $stock->update();

      // return $qty;
    }
    public function tambahi_stock(Request $request)
    {
      $get_item = Stock::where('s_id_item',$request->id_barang_del)->get();
      $qtyAwal = '';
      $id_item = '';

      foreach ($get_item as $key => $value) {
        $id_item = $value->s_id;
        $qtyAwal = $value->s_qty;
      }

      $qtyTotal = $qtyAwal + $request->qty ;

      $stock = Stock::find($id_item);
      // $stock
      $stock->s_qty = $qtyTotal;
      $stock->update();

      return response()->json(['stock' => $stock], 200);


    }


}
