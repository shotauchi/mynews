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

        // 画像は使わないので、不要の処理
        // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
        if (isset($form['image'])) {
            $path = $request->file('image')->store('public/image');
            $profile->image_path = basename($path);
        } else {
            $profile->image_path = null;
        }

        // フォームから送信されてきた_tokenを削除する
        unset($form['_token']);
        // 画像は使わないので、不要の処理
        // フォームから送信されてきたimageを削除する
        unset($form['image']);

        // フォームで入力された値を $profile に反映する
        $profile->fill($form);
        // データベースに保存する
        $profile->save();

        return redirect('admin/profile/create');
    }

    // 以下を追記
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Profile::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = Profile::all();
        }
        return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    // 以下を追記

    public function edit(Request $request)
   {
        // News Modelからデータを取得する
        $profile = profile::find($request->id);
        if (empty($profile)) {
            abort(404);
        }
        return view('admin.profile.edit', ['Profile_form' => $profile]);
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
// 以下を追記
        $history = new History();
        $history->profile_id = $profile->id;
        $history->edited_at = Carbon::now();
        $history->save();
        
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
