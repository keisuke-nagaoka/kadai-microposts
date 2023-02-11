<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserFollowController extends Controller
{
    /**
     * 
     * @param $id 相手ユーザのid
     * @return \Illuminate\Http\Response
     */
     public function store($id)
     {
         // 認証済ユーザ（閲覧者）が、idのユーザをフォローする
         \Auth::user()->follow(id);
         // 前のURLへリダイレクトさせる
         return back();
     }
     
     /**
      * ユーザをアンフォローするアクション
      * 
      * @param $id 相手ユーザのid
      * @return \Illuminate\Http\Response
      */
      public function destroy($id)
      {
          // 認証済ユーザ（閲覧者）が、idのユーザをアンフォローする
          \Auth::user()->unfllow($id);
          // 前のURLへリダイレクトさせる
          return back();
      }
}
