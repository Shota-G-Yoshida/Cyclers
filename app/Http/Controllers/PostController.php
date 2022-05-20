<?php

namespace App\Http\Controllers;

use App\Post;
use App\Category;
use App\User;
use App\Post_User;
use App\Comment;
use Auth;
use Storage;
use Illuminate\Http\Request;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    public function index(Post $post)
    {
        return view('posts/index')->with(['posts' => $post->getPaginateByLimit()]);
    }
    /**
     * 特定IDのpostを表示する
     *
     * @params Object Post // 引数の$postはid=1のPostインスタンス
     * @return Reposnse post view
     */
     
    public function show(Post $post)
    {
        return view('posts/show')->with(['posts' => $post]);
    }
    
    public function create(Category $category)
    {
        return view('posts/create')->with(['categories' => $category->get()]);;
    }
    
    public function store(Post $post, Request $request)
    {
        $img = $request->file('image');
        if(isset($img)) {
            $path = Storage::disk('s3')->putFile('img', $img, 'public');
            $post->image = basename($path);
        }
        $input = $request['post'];
        $post->fill($input)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function edit(Post $post)
    {
        return view('posts/edit')->with(['post' => $post]);
    }
    
    public function update(PostRequest $request, Post $post)
    {
        $input_post = $request['post'];
        $post->fill($input_post)->save();
        return redirect('/posts/' . $post->id);
    }
    
    public function delete(Post $post)
    {
        $post->delete();
        return redirect('/');
    }
    
    public function ranking(Post $post)
    {
        $test = $post->ranking();
        return view('posts/ranking')->with(['posts' => $post->ranking()]);
    }
}

?>