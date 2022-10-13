<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function loginPage()
    {
        return view('backend.pages.auth.login');
    }
    public function login(Request $request)
    {
        $validated = $request->validate([

            'email'=> 'required|email',
            'password'=> 'required|string|min:5',

        ]);

        $credintials = [
        'email'=>$request->email,
        'password'=>$request->password,
        ];



        if(Auth::attempt($credintials, $request->filled('remember'))){
            $request->Session()->regenerate();
            // return redirect()->intended('backend.pages.dashboard');
            return redirect()->intended('admin/dashboard');
         }
         return back()->withErrors([
        'email'=>'Wrong Crediential Found!'
         ])->onlyInput('email');
        }



        public function logout(Request $request){
            Auth::logout();
            $request->session()->invalidate();
            // $request->session()->regenerateToken();
              return redirect()->route('admin.login');
        }
    }


