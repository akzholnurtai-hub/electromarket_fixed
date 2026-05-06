<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ElectroMarketController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function products()
    {
        return view('products');
    }

    public function analytics()
    {
        return view('analytics');
    }

    public function about()
    {
        return view('about');
    }

    public function loginForm()
    {
        return view('login');
    }

    public function loginCheck(Request $request)
    {
        $dLogin = "Akzhol";
        $dPassword = "12345";

        $login = $request->input('login');
        $password = $request->input('password');

        if ($login == $dLogin && $password == $dPassword) {
            $message = "Login successful";
        } else {
            $message = "Wrong login or password";
        }

        return view('login', compact('message'));
    }

    public function registerForm()
    {
        return view('register');
    }

    public function registerSubmit(Request $request)
    {
        $data = $request->all();
        return view('register-result', compact('data'));
    }
}