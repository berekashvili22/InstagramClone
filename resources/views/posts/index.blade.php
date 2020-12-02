@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-1 p-1 d-flex align-items-center">
        <img src="{{ auth()->user()->profile->profileImage() }}" alt="" class="rounded-circle w-50 mr-2">
        <a href="/profile/{{ auth()->user()->id }}">{{ auth()->user()->username }}</a>
    </div>
    <hr>
 @foreach ($posts as $post)
 <div class="mb-5">
    <div class="row mb-1">
        <div class="col-6 offset-3 d-flex align-items-center">
            <div class="pr-3">
                <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px" alt="">
            </div>
            <div>
                <div class="font-weight-bold">
                    <a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span></a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 offset-3">
            <a href="{{ route('posts.show', $post->id) }}">
                <img src="/storage/{{ $post->image }}" class="post-image w-100" alt="">
            </a>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-6 offset-3">
            <div>
                <p><span class="font-weight-bold mr-2"><a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span></a></span>{{ $post->caption }}</p>
                <hr>
            </div>
        </div>
    </div>
</div>
 @endforeach
 <div class="row col-12 d-flex justify-content-center">
     {{ $posts->links() }}
 </div>
</div>
@endsection
