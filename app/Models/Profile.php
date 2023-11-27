<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = array('id');

    // 課題９－５）
    // 【応用】 Modelを作成するコマンドで Profile というModelを作成し、
    // 名前(name)、性別(gender)、趣味(hobby)、自己紹介(introduction)に対して
    // Validationをかけるようにしてみましょう
    public static $rules = array(
        // 名前(name)
        // 性別(gender)
        // 趣味(hobby)
        // 自己紹介(introduction)
        'name' => 'required',// 名前カラムは必須とする
        'gender' => 'required',
        'hobby' => 'required',
        'introduction' => 'required',
    );
    
}
