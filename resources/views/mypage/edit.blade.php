<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        @extends('layouts.app')　　　　　　　　　　　　　　　　　　

        @section('content')
        <h1 class="title">編集画面</h1>
        <div class="content">
            <form action="/mypage/{{ $user->id }}" method="POST">
                @csrf
                @method('PUT')
                <div class='content__name'>
                    <h2>ユーザーネーム</h2>
                    <input type='text' name='user[name]' value="{{ $user->name }}">
                </div>
                <div class='content__age'>
                    <h2>生年月日</h2>
                    <input type='date' name='user[age]' value="{{ $user->age }}" max='9999-12-20'>
                </div>
                <div class='content__sex'>
                    <h2>性別</h2>
                    @if($user->sex == 'man')
                        <p>
                            <input id='sex1' type='radio' name='user[sex]' value='man' checked>男性
                            <input id='sex2' type='radio' name='user[sex]' value='woman'>女性                                    
                            <input id='sex3' type='radio' name='user[sex]' value='others'>その他
                        </p>
                    @elseif($user->sex == 'woman')
                        <p>
                            <input id='sex1' type='radio' name='user[sex]' value='man'>男性
                            <input id='sex2' type='radio' name='user[sex]' value='woman' checked>女性                                    
                            <input id='sex3' type='radio' name='user[sex]' value='others'>その他
                        </p>
                    @else
                        <p>
                            <input id='sex1' type='radio' name='user[sex]' value='man'>男性
                            <input id='sex2' type='radio' name='user[sex]' value='woman'>女性                                    
                            <input id='sex3' type='radio' name='user[sex]' value='others' checked>その他
                        </p>
                    @endif
                </div>
                <input type="submit" value="保存">
            </form>
        </div>
        <p><a href='/mypage/{{ $user->id }}'>戻る</a></p>
        @endsection
    </body>
</html>