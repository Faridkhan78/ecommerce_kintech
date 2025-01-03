<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function create_user()
    {
        return view('admin.users.create');
    }
    public function show_user()
    {
        // $users = User::all();
        $users = User::where('role', '=', 'customer')->get();
        return view('admin.users.index', compact('users'));
    }

    public function stor_user(Request $request)
    {
        try {
            $users = new User();
            //dd($users);
            $users->name = $request->cname;
            $users->email = $request->cemail;

            $users->password = Hash::make($request->password);
            $users->number = $request->cnum;
            $users->address = $request->caddress;
            // 
            if ($request->hasFile("cimg")) {
                $img = time() . '-' . $request->cimg->getClientOriginalName();
                $request->cimg->move(public_path('users-profile/'), $img);
                $users->image = 'users-profile/' . $img;
            }
            $users->save();
            return redirect('show-user');
        } catch (\Exception $e) {
            Log::error('User creation failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create user.');
        }
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
    public function delete_user(int $id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return redirect('show-user')->with('success', 'User deleted successfully.');
        } else {
            return redirect('show-user')->with('error', 'User not found.');
        }
    }

    public function edit_user($id)
    {
        $user = User::find($id);
        return view('admin.users.edit', compact('user'));
    }
    public function update_user(int $id, Request $request)
    {
        $users = User::find(id: $id);
        $users->name = $request->cname;
        $users->email = $request->cemail;

        $users->password = Hash::make($request->password);
        $users->number = $request->cnum;
        $users->address = $request->caddress;
        // 
        if ($request->hasFile("cimg")) {

            if (file_exists(public_path('users-profile/' . $users->image))) {
                unlink(public_path('users-profile/' . $users->image));  // delete old image if exists

            }

            $img = time() . '-' . $request->cimg->getClientOriginalName();
            $request->cimg->move(public_path('users-profile/'), $img);
            $users->image = 'users-profile/' . $img;
        }
        $users->update();
        return redirect('show-user');
        return view('admin.users.edit', compact('user'));
    }
    // category action

    public function show_category()
    {
        // $users = User::all();
        $cat = Category::all();
        //dd($cat);

        return view('admin.categories.index', compact('cat'));
    }
    public function create_category()
    {
        // return "create page";
        return view('admin.categories.create');
    }
    public function store_category(Request $request)
    {

        $cat = new Category();
        //dd($users);
        $cat->name = $request->cname;
        $cat->status = $request->cstatus;
        $cat->save();
        return redirect('show-category');
    }
    public function delete_category(int $id)
    {
        $cat = Category::find($id);
        $cat->delete();
        return redirect('show-category')->with('success', 'Category deleted successfully.');
        return "delete page";
        return redirect('show-category');
        //return view('admin.categories.delete');
    }

    public function edit_category(int $id)
    {

        $cat = Category::find($id);
        //  dd($cat);
        return view('admin.categories.edit', compact('cat'));
    }
    public function update_category(int $id, Request $request)
    {

        $cat = Category::find($id);
        //dd($cat);
        $cat->name = $request->cname;
        $cat->status = $request->cstatus;
        $cat->update();
        return redirect('show-category');
    }
}
