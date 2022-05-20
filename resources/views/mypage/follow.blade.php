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
        <h1 class='top'>フォロー</h1>
        <div class='mypage'>
            <div class='follow'>
                <p>{{ $user->followed()->find(1) }}</p>
            </div>
            <p>[<a href='/mypage/{{ Auth::user()->id }}'>戻る</a>]</p>
        </div>
        @endsection
    </body>
</html>