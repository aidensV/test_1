<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use App\Unit;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::join('m_unit','i_id_unit','=','u_id')->get();
        // dd($item);
        return view('data_item.index',compact('item'))->with('no',1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $unit = Unit::all();
      return view('data_item.create',compact('unit'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $item = new Item;
      $item->i_name = $request['i_name'] ;
      $item->i_id_unit = $request['i_id_unit'] ;
      $item->save();
      // dd($item);
      return redirect('data_item');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $item = Item::find($id);
      $unit = Unit::all();

      return view('data_item.edit',compact('item','unit'));
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
      $item = Item::find($id);
      $item->i_name = $request['i_name'] ;
      $item->i_id_unit = $request['i_id_unit'] ;
      $item->update();
      // dd($item);
      return redirect('data_item');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        return back();
    }
}
