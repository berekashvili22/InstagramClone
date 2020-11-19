<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comments;
use App\User;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');

        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }
    
    public function store()
    {
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public'); 

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]); //set foreing key to post automaticly & set image value to imagepath 

        return redirect('/profile/'. auth()->user()->id);
    }

    public function show(\App\Post $post) //fetch whole post instead of id
    {   
        $post_id = $post->id;
        $comments = Comments::where('post_id', $post_id)->get();

        $likers_ids = $post->likers()->pluck('users.id'); 
        $liker_users = User::WhereIn('id', $likers_ids)->get();

        $likes = (auth()->user()) ? auth()->user()->likes->contains($post->id) : false;
            
        // dd($likes);

        return view('posts.show', compact('post', 'comments', 'likes', 'liker_users'));
    }

}
