<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Stock;
use App\Owner;
use Auth;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $id_owner = Auth::User()->owner_id;

      $stock = Stock::join('m_item','s_id_item','=','i_id')->join('m_owner','s_id_owner','=','o_id')->where('s_id_owner',$id_owner)->get();
      // dd($item);
      return view('data_stock.index',compact('stock'))->with('no',1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $item = Item::all();
      $id_owner = Auth::User()->owner_id;
      $owner = Owner::where('o_id',$id_owner)->get();

      // dd($owner);
      return view('data_stock.create',compact('item','owner'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $stock = new Stock;
      $stock->s_id_owner = $request['s_id_owner'] ;
      $stock->s_id_item = $request['s_id_item'] ;
      $stock->s_qty = $request['s_qty'] ;
      $stock->save();
      // dd($item);
      return redirect('data_stock');
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
      $stock = Stock::find($id);
      $item = Item::all();
      $id_owner = Auth::User()->owner_id;
      $owner = Owner::where('o_id',$id_owner)->get();

      return view('data_stock.edit',compact('item','owner','stock'));
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
      $stock = Stock::find($id);
      $stock->s_id_owner = $request['s_id_owner'] ;
      $stock->s_id_item = $request['s_id_item'] ;
      $stock->s_qty = $request['s_qty'] ;
      $stock->save();
      // dd($item);
      return redirect('data_stock');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $stock = Stock::find($id);
        $stock->delete();
        return back();
    }
}
