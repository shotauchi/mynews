<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// 以下の1行を追記することで、Profile Modelが扱えるようになる
use App\Models\Profile;
// 以下を追記
use App\Models\History;
// 以下を追記
use Carbon\Carbon;

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

        $profile = new profile;
        $form = $request->all();

        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $news->image_path = basename($path);
        } else {
            $profile->image_path = null;
        }

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        // データベースに保存する
        $profile->fill($form);
        

        return redirect('admin/profile');
    }

    // 以下を追記
    public function index(Request $request)
    {
        $cond_name = $request->cond_name;
        if ($cond_name != '') {
            // 検索されたら検索結果を取得する
            $posts = Profile::where('name', $cond_name)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = Profile::all();
        }
        return view('admin.profile.index', ['posts' => $posts, 'cond_name' => $cond_name]);
    }
    // 以下を追記

    public function edit(Request $request)
   {
        // News Modelからデータを取得する
        $profile = profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['news_form' => $profile
        ]);
    }

    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, profile::$rules);
        // News Modelからデータを取得する
        $profile = profile::find($request->id);
        // 送信されてきたフォームデータを格納する
        $profile_form = $request->all();

        if ($request->remove == 'true') {
            $profile_form['image_path'] = null;
        } elseif ($request->file('image')) {
            $path = $request->file('image')->store('public/image');
            $profile_form['image_path'] = basename($path);
        } else {
            $profile_form['image_path'] = $profile->image_path;
        }

        unset($profile_form['image']);
        unset($profile_form['remove']);
        unset($profile_form['_token']);

        // 該当するデータを上書きして保存する
        $profile->fill($profile_form)->save();

        return redirect('admin/profile');
    }
    // 以下を追記

    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $profile = profile::find($request->id);

        // 削除する
        $profile->delete();

        return redirect('admin/profile/');
    }
}
