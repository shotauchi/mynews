{{-- 
課題６－４）
【応用】 プロフィール作成画面用に、resources/views/admin/profile/create.blade.php
ファイルを作成し、3. で作成した profile.blade.phpファイルを読み込み、
また プロフィールのページであることがわかるように titleとcontentを編集しましょう
（ヒント: resources/views/admin/news/create.blade.php を参考にします）
--}}
@extends('layouts.profile'){{-- 3. で作成した profile.blade.phpファイルを読み込み --}}

{{-- プロフィールのページであることがわかるように titleとう --}}
@section('title', 'プロフィールの新規作成')
{{-- contentを編集しましょ --}}
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <h2>プロフィール新規作成</h2>
                <form action="{{ route('admin.profile.create') }}" method="post" enctype="multipart/form-data">

                    {{--
                    課題９－６）
                    【応用】 resources/views/admin/profile/create.blade.php を開いて、
                    Validationでエラーが発生した場合にエラーが表示されるようになっているか確認してみましょう
                    --}}
                    @if (count($errors) > 0)
                        <ul>
                            @foreach($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="form-group row">
                        <label class="col-md-2">タイトル</label>
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">本文</label>
                        <div class="col-md-10">
                            <textarea class="form-control" name="body" rows="20">{{ old('body') }}</textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-md-2">画像</label>
                        <div class="col-md-10">
                            <input type="file" class="form-control-file" name="image">
                        </div>
                    </div>
                    @csrf
                    <input type="submit" class="btn btn-primary" value="送信">
                </form>
            </div>
        </div>
    </div>
@endsection



