<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        // 認証ユーザー前提の場合
        $request->validate([
            'exhibition_id' => 'required|exists:exhibitions,id',
        ]);

        Favorite::firstOrCreate([
            'user_id' => Auth::id(),
            'exhibition_id' => $request->exhibition_id,
        ]);

        return back()->with('success', 'お気に入りに追加しました');
    }
}
