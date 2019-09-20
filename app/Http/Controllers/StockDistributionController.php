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

class StockDistributionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id_owner = Auth::User()->owner_id;
        $item = Stock::join('m_item','s_id_item','=','i_id')->where('s_id_owner',$id_owner)->get();
        $owner = Owner::all();
        $unit = Unit::all();
        return view('distribution.index',compact('owner','item','unit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
      $dist->from = $id_owner_from;
      $dist->destination = $request->o_id[0];
      $dist->status = 's';
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
        //
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
}
