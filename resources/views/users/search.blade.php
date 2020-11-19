@extends('layouts.app')

@section('content')
<div class="container mt-5" style="margin-left: 20%">
    @foreach ($users as $user)
        <div class="d-flex mb-5" style="margin: auto">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100 mr-4" style="max-width: 60px" alt="">
            <div class="d-flex" style="flex-direction: column">
                <a href="/profile/{{ $user->id }}"><span class="text-dark">{{ $user->username }}</span></a>
                <p class="text-muted">{{ $user->profile->title }}</p>
            </div>
            <div>
                @if(auth()->user() ? auth()->user()->following->contains($user->id) : false)
                    <strong class="ml-3 mt-1">Following</strong>
                @endif
            </div>
        </div>
        <hr>
    @endforeach
</div>
@endsection
