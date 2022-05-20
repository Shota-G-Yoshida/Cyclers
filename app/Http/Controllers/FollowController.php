<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class FollowController extends Controller
{
    public function store(User $user)
    {
        $user->following()->attach(Auth::id());
        return redirect('/mypage/' . $user->id);
    }
    
    public function destroy(User $user)
    {
        $user->following()->detach(Auth::id());
        return redirect('/mypage/' . $user->id);
    }
    
    public function FollowUser(User $user)
    {
        dd($user->followed()->get());
        return view('mypage/follow')->with([ 'user' => $user ]);
    }
    
    public function FollowingUser(User $user)
    {
        dd($user->following()->find(1));
        return view('mypage/following')->with([ 'user' => $user->orderBy('updated_at', 'DESC') ]);
    }
}
