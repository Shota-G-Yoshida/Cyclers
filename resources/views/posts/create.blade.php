<!DOCTYPE HTML>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <title>Blog</title>
    </head>
    <body>
        <h1>投稿する</h1>
        <form action="/posts" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="title">
                <h2>目的地</h2>
                <input class="form-control form-control-lg w-25" type="text" name="post[title]"  value="{{ old('post.title') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.title') }}</p>
            </div>
            <div class="distance">
                <h2>走行距離</h2>
                <input class="form-control form-control-lg w-25" type="text" name="post[distance]" value="{{ old('post.distance') }}"/>
                <p class="title__error" style="color:red">{{ $errors->first('post.distance') }}</p>
            </div>
            <div class="difficulty">
                <h2>難易度</h2>
                <select name="post[difficulty_id]">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="body">
                <h2>感想</h2>
                
                <textarea class="form-control form-control-lg w-25" name="post[body]" row="3">{{ old('post.body') }}</textarea>
                <p class="body__error" style="color:red">{{ $errors->first('post.body') }}</p>
            </div>
            <div class="file">
                <h2>画像</h2>
                <input type="file" name="image">
            </div>
            <input type='hidden' name="post[user_id]" value="{{ Auth::user()->id }}">
            <input type="submit" value="保存"/>
        </form>
        <div class="back">[<a href="/">back</a>]</div>
    </body>
</html>