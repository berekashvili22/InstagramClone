@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        {{-- post image --}}
        <div class="p-pic-cont col-7">
            <img src="/storage/{{ $post->image }}" class="w-100">
        </div>
        <div class="col-5">
            <div>
                {{-- post info --}}
                <div class="d-flex align-items-center">
                    <div class="pr-3">
                        <img src="{{ $post->user->profile->profileImage() }}" class="rounded-circle w-100" style="max-width: 40px" alt="">
                     </div>
                    <div>
                        <div class="font-weight-bold">
                            <a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span></a>
                        </div>
                    </div>
                </div>
                <hr>
                <p><span class="font-weight-bold mr-2"><a href="/profile/{{ $post->user->id }}"><span class="text-dark">{{ $post->user->username }}</span></a></span>{{ $post->caption }}</p>
                {{-- comments --}}
                <div class="comments overflow-auto">
                    @foreach ($comments as $comment)
                        <div class="d-flex mb-3 ">
                            <img src="{{ $comment->user->profile->profileImage() }}" alt="" class="rounded-circle w-100 mr-3" style="max-width: 40px">
                            <a href="/profile/{{ $comment->user->id }}" class="comm-user-link" style="color: #333"><span class="comment-user">{{ $comment->user->username }}</span></a>
                            <p class="pl-2">{{ $comment->text }}</p>
                        </div>
                    @endforeach
                </div>
                {{-- add comment --}}
                <div>
                    <form action="/p/comment" enctype="multipart/form-data" method="post">
                        @csrf
                            <div class="pt-4">
                                <div class="form-group row">
                                    <input type="hidden" name="post_id" id="post_id" value="{{ $post->id }}">
                                    <input id="text" name="text" type="text" class="form-control @error('text') is-invalid @enderror" value="{{ old('text') }}"   placeholder="Add a comment..." autofocus>
                                    @error('text')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                       </form>
                </div>
                {{-- end add comment --}}
            </div>
        </div>
    </div>
</div>
@endsection
