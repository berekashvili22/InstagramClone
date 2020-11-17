<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user) // use App\User; 
    {

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        $following_ids = $user->following()->pluck('profiles.user_id'); 
        $following_users = User::whereIn('id', $following_ids)->get();

        $followers_ids = $user->profile->followers()->pluck('users.id'); 
        $follower_users = User::WhereIn('id', $followers_ids)->get();

        return view('profiles.index', compact('user', 'follows', 'following_users', 'follower_users'));

        
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));
    }

    public function update(User $user)
    {
        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'description' => 'required',
            'url' => '',
            'img' => '',
        ]);

        
        if (request('image')) {

            $imagePath = request('image')->store('profile', 'public'); 

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000, 1000);
            $image->save();

            $imageArray = ['image' => $imagePath];

        }
        
        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        
        return redirect("/profile/{$user->id}"); 
    }
}

