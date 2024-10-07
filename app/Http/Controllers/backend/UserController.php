<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function UserView(){
        $viewUser['allData'] = User::all();
        return view('admin.backend.user.view_user',$viewUser);
    }
    public function UserAdd(){
        return view('admin.backend.user.UserAdd');
    }

    public function UserStore(Request $request){
        $validateData = $request->validate([
            'email'=> 'required|unique:users',
            'name'=>'required'
        ]);

        $data = new User();
        $code = rand(0000,9999);
        $data->usertype = 'admin';
        $data->role = $request->role;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = bcrypt($code);
        $data->code = $code;
        $data->save();

        $notification = array(
            'message' => 'User Added Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->route('user.view')->with($notification);
    }
    public function UserEdit($id){

        $userEdit = User::find($id);
        return view('admin.backend.user.userEdit',compact('userEdit'));

    }
    public function UserUpdate(Request $request,$id){


        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->role = $request->role;
        $data->save();

        $notification = array(
            'message' => 'User Updated Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->route('user.view')->with($notification);
    }
    public function UserDelete($id){
        $data = User::find($id);
        $data->delete();

        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'warning'
        );

        return redirect()->route('user.view')->with($notification);
    }
}
