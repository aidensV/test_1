<?php

namespace App\Http\Controllers;
use App\Distribution;
use App\Item;
use App\DetailDistribution;
use App\Stock;
use App\Owner;
use App\Unit;
use Auth;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $dist = Distribution::join('m_owner','destination','=','o_id')->where('status','o')->get();
      return view('order.index',compact('dist'))->with('no',1);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $id_owner = Auth::User()->owner_id;
      $item = Stock::join('m_item','s_id_item','=','i_id')->where('s_id_owner',$id_owner)->get();
      $owner = Owner::all();
      $unit = Unit::all();
      return view('order.create',compact('owner','item','unit'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $nom = Distribution::max('id');
      $bulanRomawi = array("", "I","II","III", "IV", "V","VI","VII","VIII","IX","X", "XI","XII");
      $AWAL = 'DST';
      $no = 1;
      $no_nota='';
      // dd($nom);

      if($nom) {
        $no_noto = sprintf("%03s", abs($nom + 1)). '/' . $AWAL .'/' . $bulanRomawi[date('n')] .'/' . date('Y');
    }
    else {
       $no_nota = sprintf("%03s", $no). '/' . $AWAL .'/' . $bulanRomawi[date('n')] .'/' . date('Y');
    }

    $id_owner_from = Auth::user()->owner_id;
      $dist = new Distribution;
      $dist->date = date('Y-m-d');
      $dist->nota = $no_nota;
      $dist->from = $request->o_id[0];
      $dist->destination = $id_owner_from;
      $dist->status = 'o';
      $dist->save();

      $input = $request->all();
      $last_id = array();

  for($i=0; $i<= count($input['jumlah']); $i++) {
    array_push($last_id,$dist->id);
    if(empty($input['jumlah'][$i]) || !is_numeric($input['jumlah'][$i])) continue;
    $data = [
      'stock_distribution_id' => $last_id[$i],
      'detail_id' => $i,
      'item_id' => $input['id_barang'][$i],
      'qty' => $input['jumlah'][$i],
      'unit' => $input['satuan'][$i]
    ];

      DetailDistribution::create($data);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $items = array();
      $owners = array();
        $dist_id=DetailDistribution::where('stock_distribution_id','=',$id)
        ->join('d_stock_distribution','stock_distribution_id','=','id')
        ->orderBy('item_id','DESC')->get();
          foreach ($dist_id as $key => $value) {
            $item = $value->item_id;
            $owner = $value->from;
            array_push($owners,$owner);
            array_push($items,$item);
          }
          $dist=DetailDistribution::join('m_item','item_id','=','i_id')
          ->join('d_stock_distribution','stock_distribution_id','=','id')
          ->join('d_stock','s_id_item' ,'=','item_id')
          ->join('m_unit','unit','=','u_id')->where('stock_distribution_id','=',$id)
          ->whereIn('s_id_item',$items)
          ->whereIn('s_id_owner',$owners)
          ->orderBy('item_id','DESC')->get();


          // dd($dist2);
      // var_dump($stock);
        $unit=Unit::all();
        return view('order.edit',compact('dist','unit','stock'))->with('no',1);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function update_qty(Request $request)
    {
      // return $request->all();
      $stock = DetailDistribution::where('stock_distribution_id',$request->dst_id)->where('detail_id',$request->dt_id)->first();
      // dd($request->qty);
      $stock->qty = $request->qty;
      $stock->save();
      return $stock;
    }
    public function update_unit(Request $request)
    {
      // return $request->all();
      $unit = DetailDistribution::where('stock_distribution_id',$request->dst_id)->where('detail_id',$request->dt_id)->first();
      $unit->unit = $request->unit;
      $unit->save();
      return $unit;
    }
    public function update_status_order(Request $request)
    {
      $arr = array();
      for ($i=0; $i < count($request->from) ; $i++) {
        $qty = Stock::where('s_id_owner',$request->from[$i])->where('s_id_item',$request->item_id[$i])->value('s_id');
        array_push($arr,$qty);

        $stock = Stock::find($arr[$i]);
        $stock->s_qty = $stock->s_qty - $request->qty[$i];
        $stock->save();
      }
      $dst = Distribution::find($request->id_dst[0]);
      $dst->status = 'r';
      $dst->save();
      return $dst;


    }
}
