<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('data_user.index');
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
      $users = new User;
      $users ->owner_id = $request['o_id'];
      $users ->username = $request['username'];
      $users ->password = bcrypt($request['password']);
      $users -> save();
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
        $users = User::find($id);
        echo json_encode($users);
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
      $users = User::find($id);
      // $users ->owner_id = $request['o_id'];
      $users ->username = $request['username'];
      $users -> update();
    }
    public function update_password(Request $request, $id)
    {
      $users = User::find($id);
      // $users ->owner_id = $request['o_id'];
      $users ->password = bcrypt($request['password1']);
      $users -> update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $users = User::find($id);
      $users -> delete();
    }

    public function listData()
    {
      $users = User::orderBy('id', 'ASC')->get();
        $no = 0;
        $data = array();
        foreach ($users as $list) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->owner_id;
            $row[] = $list->username;
            $row[] = '<a onclick="editForm('.$list->id.')" class="btn btn-primary" data-toggle="tooltip" data-placement="botttom" title="Edit Data"  style="color:white; margin:5px">Edit</a>
            <a onclick="deleteData('.$list->id.')" class="btn btn-danger" data-toggle="tooltip" data-placement="botttom" title="Hapus Data" style="color:white; margin:5px">Hapus</a>
            <a onclick="changePasswordForm('.$list->id.')" class="btn btn-success" data-toggle="tooltip" data-placement="botttom" title="Change Password"  style="color:white; margin:5px">Ganti Password</i></a>';
            $data[] = $row;

        }

        $output = array("data" => $data);
        return response()->json($output);
    }
}
