<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;    // 追記
use App\Models\User;    // 追記

class UsersController extends Controller
{
    public function index()    // 追記
    {    // 追記
        // ユーザー一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);    // 追記
    
        // ユーザー一覧ビューでそれを表示
        return view('users.index', [    // 追記
        'users' => $users,    // 追記
        ]);    // 追記
    }    // 追記

    public function show($id)
    {
        // idの値でユーザーを検索して取得
        $user = User::findOrFail($id);
        
        // ユーザー詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
        ]);
    }
}