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
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザーの投稿一覧を作成日時の降順で取得
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
        
        // ユーザー詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'microposts' => $microposts,
        ]);
    }
    
    /**
     * ユーザのフォロー一覧ページを表示するアクション
     * 
     * @param $id ユーザのid
     * @return \Illuminate\Http\Responce
     */
    public function followings($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);
        
        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }
    
    /**
     * ユーザのフォロワー一覧ページを表示するアクション
     * 
     * @param $id ユーザのid
     * @return \Illminate\Http\Response
     */
    public function followers($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);
        
        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }
}