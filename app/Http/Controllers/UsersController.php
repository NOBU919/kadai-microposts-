<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    //一覧表示
    public function index()
    {
        //ユーザー一覧をidの降順で取得
        $user = User::orderBy('id','desc')->paginate(10);
        
        //ユーザー一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users,
        ]);
    }
    //詳細確認
    public function show($id)
    {
        // idの値でユーザを検索して取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザの投稿一覧を作成日時の降順で取得
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザ詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'microposts' => $microposts,
        ]);
    }
}
