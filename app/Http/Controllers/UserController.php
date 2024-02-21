<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\LoginRequest;

class UserController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            return redirect()->route('car.list');
        }

        return back()->with(['error' => 'Nazwa i hasło jest nieprawidłowe']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login.index');
    }
}
