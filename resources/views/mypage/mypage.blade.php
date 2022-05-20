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
        <h1 class='top'>マイぺージ</h1>
        <div class='mypage'>
            <div class='user'>
                <p>{{ $user->name }}</p>
                <p>
                <?php
                $now = date("Ymd");
                $birthday = str_replace("-", "", $user->age);
                echo floor(($now-$birthday)/10000).'歳';
                ?>
                </p>
                @if($user->followed()->count() > 0)
                    <a href='/mypage/{{ $user->id }}/FollowUser'><p>フォロー：{{ $user->followed()->count() }}</p></a>
                @else
                    <p>フォロー：{{ $user->followed()->count() }}</p>
                @endif
                @if($user->following()->count() > 0)
                    <a href='/mypage/{{ $user->id }}/FollowingUser'><p>フォロワー：{{ $user->following()->count() }}</p></a>
                @else
                    <p>フォロワー：{{ $user->following()->count() }}</p>
                @endif
            </div>
            @if($user->id == Auth::user()->id)
                <div class='edit'>
                    <p>[<a href='/mypage/{{ $user->id }}/edit'>プロフィールを編集する</a>]</p>
                </div>
            @elseif($user->following()->where('followed_user_id', Auth::id())->exists())
                <form action='/mypage/{{ $user->id }}/unfollow' method='POST'>
                @csrf
                    <div class='unfollow'>
                        <input type='submit' value='フォローを解除する'>
                    </div>
                </form>
            @else
                <form action='/mypage/{{ $user->id }}/follow' method='POST'>
                @csrf
                    <div class='follow'>
                        <input type='submit' value='フォローする'>
                    </div>
                </form>                
            @endif
        </div>
        @forelse($posts as $post)
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
            @empty
                <p>まだ投稿がありません</p>
            </div>
        @endforelse
        <p>[<a href='/'>戻る</a>]</p>
        @endsection
    </body>
</html>