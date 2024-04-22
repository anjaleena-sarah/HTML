<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function registerview(){
        return view('register');
    }
    public function register(Request $request){
        $request->validate([
            'name'=>'required','min:5',
            'password'=>'required','min:5',
            'email'=>'required',
        ]);

        User::create([
            'email'=>$request->email,
            'name'=>$request->name,
            'password'=>$request->password,   
        ]);
        return redirect('/login')->with('status','registration sucessfull');
    }
    public function loginview(){
        return view('/login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if(Auth::attempt($credentials))
        {
            //Authentication passed
            return redirect()->intended('/dashboard');

        }

        return back()->withErrors(['email'=> 'The provided credentials do not match our records'
    ]);

   }

   public function dash(){
    return view('/dashboard');
}

}
