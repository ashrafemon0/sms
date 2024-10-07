<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function UserProfile(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('admin.backend.profile.viewProfile',compact('user'));
    }
    public function ProfileEdit(){
        $id = Auth::user()->id;
        $EditProfile = User::find($id);
        return view('admin.backend.profile.EditProfile',compact('EditProfile'));
    }
    public function ProfileUpdate(Request $request){

        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->gender = $request->gender;
        $data->mobile = $request->mobile;
        $data->address = $request->address;

        if ($request->file('image')){
            $file = $request->file('image');
            @unlink(public_path('upload/user_image/'.$data->image));
            $fileName = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_image'),$fileName);
            $data['image'] = $fileName;
        }
        $data->save();

        $notification = array(
            'message' => 'User Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.profile')->with($notification);
    }
    public function ChangePassword(){
        return view('admin.backend.profile.changePassword');
    }
    public function SavePassword(Request $request){
        $validatedData = $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $hashPassword = Auth::user()->password;
        if (Hash::check($request->current_password,$hashPassword)){
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        }else{
            return redirect()->back();
        }
    }
}
