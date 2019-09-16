<?php

namespace App\Http\Controllers;

use App\Sales;
use App\Item;
use App\DetailSales;

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
        $item = Item::all();
        return view('sales.index',compact('item'));
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
    public function get_data_barang($id)
    {
      $item = Item::find($id);
      // dd($item);
      return $item;
    }
}
