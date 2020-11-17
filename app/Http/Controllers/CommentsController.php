<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store()
    {
        $data = request()->validate([
            'text' => 'required',
            'post_id' => '',
        ]);

        auth()->user()->comments()->create([
            'text' => $data['text'],
            'post_id' => $data['post_id'],
        ]); //sets foreing key to post automaticly & set image value to imagepath 

        return redirect('/p/'. $data['post_id']);
    }
}
