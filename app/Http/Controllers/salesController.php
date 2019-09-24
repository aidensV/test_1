<?php

namespace App\Http\Controllers;

use App\Sales;
use App\Item;
use App\DetailSales;
use App\Stock;
use App\Owner;
use App\Unit;
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
        $unit = Unit::all();
        $owner = Owner::where('o_id',$id_owner)->get();
        // $owner = Stock::join('m_owner','s_id_owner','=','o_id')->join('m_item','s_id_item','=','i_id')->get();
        // dd($owner);
        return view('sales.index',compact('item','owner','unit'));
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

      $input = $request->all();
      $last_id = array();


  for($i=0; $i<= count($input['jumlah']); $i++) {
    array_push($last_id,$sales->id);


    if(empty($input['jumlah'][$i]) || !is_numeric($input['jumlah'][$i])) continue;


    $data = [
      'sales_id' => $last_id[$i],
      'detail_id' => $i,
      'item_id' => $input['id_barang'][$i],
      'value' => $input['barang_harga'][$i],
      'qty' => $input['jumlah'][$i],
      'total_net' => $input['tot'][$i],
      'unit_id' => $input['unit_id'][$i]
    ];
     DetailSales::create($data);

    }
  // return var_dump($data);

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

    public function get_unit_barang($id)
    {


      $item = Item::find($id);
      $unit_1 = $item->i_unit1;
      $unit_2 = $item->i_unit2;
      $unit_3 = $item->i_unit3;
      $price = $item->price;
      $units = [$unit_1,$unit_2,$unit_3];

      $unit = Unit::whereIn('u_id',$units)->get();

      return json_encode($unit);
      // return $item;
    }

    public function get_harga_barang($id)
    {
      $item = Item::find($id);
      $price = $item->i_price;
      return json_encode($price);

    }

    // public function cek_item(Request $request)
    // {
    //   // dd($request['id_barang']);
    //
    //   $item = Item::where('i_id',$request['id_barang'])->get();
    //   foreach ($item as $value) {
    //     // dd($value->toArray());
    //     foreach ($value->toArray() as $key => $value2) {
    //       if ($value2 == $request['u_id']) {
    //         if ($key == 'i_unit3') {
    //             return $value['i_unitcompare3'];
    //         }elseif ($key == 'i_unit2') {
    //             return $value['i_unitcompare2'];
    //         }elseif ($key == 'i_unit1') {
    //           return $value['i_unitcompare1'];
    //         }else {
    //           return 'no unit';
    //         }
    //       }
    //     }
    //   }
    // }
    public function cek_item($id_barang, $id_unit)
    {
      // dd($request['id_barang']);

      $item = Item::where('i_id',$id_barang)->get();
      foreach ($item as $value) {
        // dd($value->toArray());
        foreach ($value->toArray() as $key => $value2) {
          if ($value2 == $id_unit) {
            if ($key == 'i_unit3') {
                return $value['i_unitcompare3'];
            }elseif ($key == 'i_unit2') {
                return $value['i_unitcompare2'];
            }elseif ($key == 'i_unit1') {
              return $value['i_unitcompare1'];
            }else {
              return 'no unit';
            }
          }
        }
      }
    }






}
