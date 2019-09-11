<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Owner;

class OwnerController extends Controller
{

     public function index()
     {
       $owner = Owner::all();
         return view('data_owner.index',compact('owner'))->with('no',1);
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
         return view('data_owner.create');
     }

     /**
      * Store a newly created resource in storage.
      *
      * @param  \Illuminate\Http\Request  $request
      * @return \Illuminate\Http\Response
      */
     public function store(Request $request)
     {
        $Owner = new Owner;
        $Owner->o_name = $request['o_name'] ;
        $Owner->o_address = $request['o_address'] ;
        $Owner->save();
        return redirect('data_owner');
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
         $owner = Owner::find($id);
         // dd($Owner);
         return view('data_owner.edit',compact('owner'));
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
         $Owner= Owner::find($id);
         $Owner->o_name = $request['o_name'] ;
         $Owner->o_address = $request['o_address'] ;
         $Owner->update();
         return redirect('data_owner');
     }

     /**
      * Remove the specified resource from storage.
      *
      * @param  int  $id
      * @return \Illuminate\Http\Response
      */
     public function destroy($id)
     {
         $Owner = Owner::find($id);
         $Owner->delete();
         return back();
     }
 }
