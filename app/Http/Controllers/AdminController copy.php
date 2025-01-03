<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function dashboard(){
        return view('admin.dashboard');
    }

    public function create_user(){
        return view('admin.users.create');
    }
    public function show_user(){
        // $users = User::all();
        $users = User::where('role','=','customer')->get();
        return view('admin.users.index',compact('users'));
    }

    // public function stor_user(Request $request){
     
    //     $users = new User();
    //     //dd($users);
    //     $users->name = $request->cname;
    //     $users->email = $request->cemail;

    //     $users->password = Hash::make($request->password);
    //     $users->number = $request->cnum;
    //     $users->address = $request->caddress;
    //     // 
    //     if($request->hasFile("cimg")){
    //         $img = time().'-'.$request->cimg->getClientOriginalName();
    //         $request->cimg->move(public_path('users-profile/'),$img);
    //         $users->image ='users-profile/'. $img;
    //     }
    //     $users->save();
    //     return redirect('show-user');
    // }
    public function stor_user(Request $request){
     
        $users = new User();
        //dd($users);
        $users->name = $request->cname;
        $users->email = $request->cemail;
        
        $users->password = Hash::make($request->password);
        $users->number = $request->cnum;
        $users->address = $request->caddress;
        // 
        if($request->hasFile("cimg")){
            $img = time().'-'.$request->cimg->getClientOriginalName();
            $request->cimg->move(public_path('users-profile/'),$img);
            $users->image ='users-profile/'. $img;
        }
        $users->save();
        return redirect('show-user');
    }
}
