<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// 以下の1行を追記することで、Profile Modelが扱えるようになる
use App\Models\Profile;

class ProfileController extends Controller
{
    
    public function add()
    {
        return view('admin.profile.create');
    }
    public function create(Request $request)
    {
        // 以下を追記
        // Validationを行う
        // 課題９－６）
        // 【応用】 resources/views/admin/profile/create.blade.php を開いて、
        // Validationでエラーが発生した場合にエラーが表示されるようになっているか確認してみましょう
        $this->validate($request, Profile::$rules);

        // $news = new News;
        // $form = $request->all();

        // // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        // if (isset($form['image'])) {
        //     $path = $request->file('image')->store('public/image');
        //     $news->image_path = basename($path);
        // } else {
        //     $news->image_path = null;
        // }

        // // フォームから送信されてきた_tokenを削除する
        // unset($form['_token']);
        // // フォームから送信されてきたimageを削除する
        // unset($form['image']);

        // // データベースに保存する
        // $news->fill($form);
        // $news->save();

        return redirect('admin/profile/create');
    }
    

    public function edit()
    {
        return view('admin.profile.edit');
    }
    public function update()
    {
        return redirect('admin/profile/edit');
    }
        
}