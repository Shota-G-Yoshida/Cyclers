<?php

namespace App;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;

    public function getPaginateByLimit(int $limit_count = 10)
    {
        // updated_atで降順に並べたあと、limitで件数制限をかける
        return $this::with('category')->orderBy('updated_at', 'DESC')->paginate($limit_count);
    }
    
    protected $fillable = [
        'title',
        'body',
        'distance',
        'difficulty_id',
        'user_id',
        'image'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category', 'difficulty_id');
    }
    
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
    
    public function users()
    {
        return $this->belongsToMany('App\User', 'post_user', 'post_id', 'user_id');
    }
    
    public function comment()
    {
        return $this->hasMany('App\Comment', 'post_id');
    }
    
    public function ranking()
    {
        return $this::select('*')->join('post_user', 'post_user.post_id', '=', 'posts.id')
        ->groupBy('post_id')
        ->orderBy(DB::raw('count(post_user.post_id)'), 'DESC')
        ->get();
    }
}
