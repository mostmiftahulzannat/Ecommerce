<?php

namespace App\Http\Controllers\frontend\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserStoreRequest;
use Illuminate\Auth\Events\Validated;

class RegisterController extends Controller
{
    public function registerPage()
    {
        return view('frontend.pages.Auth.register');
    }


  public function loginPage()
  {
   return view('frontend.pages.Auth.login');
  }


    public function registerStore(UserStoreRequest $request)
    {
    $user = User::create([
             'name'=>$request->name,
             'email'=>$request->email,
             'phone'=>$request->phone,
             'password'=>Hash::make($request->password),
    ]);
    // return $user;
    $credintials = [
        'name'=>$request->name,
        'password'=>$request->password,
    ];
    if(Auth::attempt($credintials,$request->filled('remember')) ){
        $request->session()->regenerate();
        return redirect()->route('customer.dashboard');

    }

    }


    public function loginStore(Request $request)
    {
        $validated = $request->validate([
    'email'=>'required|email',
    'password' => 'required|string|min:4'
        ]);
        $credintials = [
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(Auth::attempt($credintials, $request->filled('remember'))){
            $request->session()->regenerate();
            return redirect()->route('customer.dashboard');
        }
        return back()->withErrors([
            'email' => 'Wrong Credintial Found!'
        ])->onlyInput('email');
    }


    public function logOut(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        // $request->session()->regenerateToken();
        return redirect()->route('login.page');
    }
}
