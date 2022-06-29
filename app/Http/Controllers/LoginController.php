<?php

namespace App\Http\Controllers;

use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;


class LoginController extends Controller
{
    public  function showForm()
    {
        return view('login');
    }
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $account = Account::where('email', $request->input('email'))->where('password', $request->input('password'))->where('is_admin', 1)->first();

        if (!empty($account)) {
            Auth::login($account);
            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => 'Sai thông tin tài khoản.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return Redirect::route('login');
    }
}
