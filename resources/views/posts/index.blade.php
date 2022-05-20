<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link rel='stylesheet' href='{{ asset("css/index.css") }}' type='text/css'>
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </head>
    <body>
        @extends('layouts.app')　　　　　　　　　　　　　　　　　　

        @section('content')
        {{ Auth::user()->name }}
        <h1 class='top'>タイムライン</h1>
        <div class='main'>
            <div class='left'>
                @foreach ($posts as $post)
                    <div class='post'>
                        <h2><a href='/mypage/{{ $post->user->id }}'>{{ $post->user->name }}</a></h2>
                        <p class='title'>
                            <a href="/posts/{{ $post->id }}">{{ $post->title }}</a>
                        </p>
                        <p class='body'>{{ $post->body }}</p>
                        <a href="/categories/{{ $post->category->id }}">{{ $post->category->name }}</a>
                    </div>
                    @if($post->users()->where('user_id', Auth::id())->exists())
                        <div>
                            <form action="/posts/{{ $post->id }}/unfavorites" method="POST">
                                @csrf
                                <input type="submit" value='👍：いいねを取り消す'>
                            </form>
                        </div>
                    @else
                        <div>
                            <form action="/posts/{{ $post->id }}/favorites" method="POST">
                                @csrf
                                <input type="submit" value='👍：いいね'>
                            </form>
                        </div>
                    @endif
                    <p>いいね数：{{ $post->users()->count() }}</p>
                @endforeach
            </div>
            <div class='right'>
                <div class='menu'>
                    <p>＞<a href="/">難易度測定</a></p>
                    <p>＞<a href="/posts/ranking">コメントランキング</a></p>
                    <p>＞<a href="/mypage/{{ Auth::user()->id }}">マイページ</a></p>
                    <p　class='create'><a href="/posts/create">投稿する</a></p>
                </div>
                <div class='paginate'>
                    {{ $posts->links() }}
                </div>　　　
            </div>
        </div>
        @endsection
    </body>
</html>