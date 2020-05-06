<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateUserDataRequest;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function userShopping()
    {
        return view('pages.shopping');
    }
    
    public function userProfile()
    {
        $user = Auth::user();
        return view('pages.profile',compact('user'));
    }

    public function updateUserData(UpdateUserDataRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->input('name');
        $user->last_name = $request->input('last_name');
        $user->address = $request->input('address');
        $user->cp = $request->input('cp');
        $user->phone = $request->input('phone');

        if(Auth::user()->email != $request->email)
        {
            $this->validate($request,[
                'email' =>'unique:users',
            ]);
            $user->email = $request->input('email');
        }
    
        if($request->filled('password'))
        { 
            $user->password =Hash::make($request->input('password'));
        }
        $user->save();
        return back()->with('info','Su información ha sido actualizado.');
    }
}
