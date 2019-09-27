<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Owner;

class UserController extends Controller
{

    public function index()
    {
        $owner = Owner::all();
        return view('data_user.index',compact('owner'));
    }

    public function store(Request $request)
    {
      $users = new User;
      $users ->owner_id = $request['o_id'];
      $users ->username = $request['username'];
      $users ->password = bcrypt($request['password']);
      $users -> save();
    }

    public function edit($id)
    {
        $users = User::find($id);
        echo json_encode($users);
    }

    public function update(Request $request, $id)
    {
      $users = User::find($id);
      if ($request['password1']) {
        $users ->password = bcrypt($request['password1']);
      }
      if ($request['username']) {
        $users ->username = $request['username'];
      }
      $users -> update();
    }

    public function destroy($id)
    {
      $users = User::find($id);
      $users -> delete();
    }

    public function listData()
    {
      $users = User::join('m_owner','owner_id','=','o_id')->orderBy('id', 'ASC')->get();
        $no = 0;
        $data = array();
        foreach ($users as $list) {

            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $list->o_name;
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
