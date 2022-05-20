<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        
    </head>
    <body>
        @extends('layouts.app')　　　　　　　　　　　　　　　　　　

        @section('content')
        {{ Auth::user()->name }}
        <h1 class='top'>フォロワー</h1>
        <div class='mypage'>
            @foreach($user as $follow)
                <div class='follow'>
                    <p>{{ $follow->following->name }}</p>
                </div>
            @endforeach
            <p>[<a href='/mypage/{{ Auth::user()->id }}'>戻る</a>]</p>
        </div>
        @endsection
    </body>
</html>