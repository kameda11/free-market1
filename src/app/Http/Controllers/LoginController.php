<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // ログイン試行
        if (Auth::attempt($request->only('email', 'password'), $request->filled('remember'))) {
            // ログイン後、index.blade.phpにリダイレクト
            return redirect()->route('index');  // 'index' はweb.phpで定義した名前付きルート
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
