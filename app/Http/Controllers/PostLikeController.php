<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class PostLikeController extends Controller
{ 
    public function store(Post $post)
    {
        return auth()->user()->likes()->toggle($post);
    }
}
