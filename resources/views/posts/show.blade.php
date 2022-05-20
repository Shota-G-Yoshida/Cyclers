<!DOCTYPE HTML>
<html lang="{{ str_replace("_", "-", app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Posts</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        @extends('layouts.app')　　　　　　　　　　　　　　　　　　

        @section('content')
        {{ Auth::user()->name }}
        <form action="/posts/{{ $posts->id }}" id="form_delete" method="POST">
            @csrf
            @method('delete')
            <input type='submit' style='display:none'>
            <p class='delete'>[<span onclick='return deletePost(this);'>delete</span>]</p>
        </form>
        <h1 class="title">
            {{ $posts->title }}
        </h1>
        <div class="content">
            <div class="content__post">
                <h3>本文</h3>
                <p>{{ $posts->body }}</p>    
            </div>
            <div class='file'>
                <img src='https://bucketshota.s3.ap-northeast-1.amazonaws.com/img/{{ $posts->image }}' width='100' height='100'>
            </div>
        </div>

        <div class='comment'>
            <p>コメント</p>
                @forelse($posts->comment as $comment)
                    <div class='comment_name'>
                        <a href='/mypage/{{ $comment->user->id }}'>
                            <p>{{ $comment->user->name }}</p>                            
                        </a>
                        <p>{{ $comment->comment }}</p>
                    </div>
                @empty
                    <p>まだコメントはありません</p>
                @endforelse
            <form action='/comment' method='POST'>
                @csrf
                <textarea name='comment'></textarea>
                <input type='hidden'name='post_id' value='{{ $posts->id }}'>
                <input type='submit' value='コメントする'>
            </form>
        </div>
        <div class="footer">
            <p class='edit'>[<a href="/posts/{{ $posts->id }}/edit">edit</a>]</p>
            <a href="/">戻る</a>
        </div>
        <script>
            function deletePost(e) {
                'use strict';
                if(confirm('本当に削除しますか')) {
                    document.getElementById('form_delete').submit();
                }
            }
        </script>
        @endsection
    </body>
</html>