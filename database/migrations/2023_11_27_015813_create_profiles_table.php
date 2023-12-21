<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // 課題９－４）
        // 【応用】 create_profiles_table というMigrationのひな形ファイルを作成し、
        // profilesというテーブル名で名前(name)、性別(gender)、趣味(hobby)、自己紹介(introduction)
        // を保存できるように修正して、 migrateしてテーブルを作成しましょう
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            // 名前(name)
            $table->string('title');// プロフィール情報の名前を保存するカラム
            $table->string('body');// 性別(gender)
            $table->string('image_path');// 趣味(hobby)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
};
