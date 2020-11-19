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
                        <div class="d-flex mb-5 ">
                            <img src="{{ $comment->user->profile->profileImage() }}" alt="" class="rounded-circle w-100 mr-3" style="max-width: 40px">
                            <a href="/profile/{{ $comment->user->id }}" class="comm-user-link" style="color: #333"><span class="comment-user">{{ $comment->user->username }}</span></a>
                            <p class="pl-2">{{ $comment->text }}</p>
                        </div>
                    @endforeach
                </div>
                {{-- like --}}
                <div class="border-top">
                    <like-button post-id="{{ $post->id }}" likes="{{ $likes }}" class="pt-2"></like-button>
                    <div>
                        <strong><p class="pl-1">{{ $post->likers->count() }} <button type="button" class="text-nowrap" style="border: none;
                            background-color: inherit; outline: none;" data-toggle="modal" data-target="#likes-modal">
                            likes
                        </button></p></strong>
                    </div>
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
{{-- bootstrap modal for likes --}}  
            <!-- Modal -->
            <div class="modal fade" id="likes-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <div class="d-flex justify-content-center w-100">
                        <h5 class="modal-title" id="exampleModalLongTitle">likes</h5>
                    </div>    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="scrollbar scrollbar-lady-lips">
                        <div class="force-overflow">
                            <div class="modal-body">
                                @foreach ($liker_users as $liker_user)
                                <div class="col-1 d-flex align-items-center mb-3">
                                    <img src="{{ $liker_user->profile->profileImage() }}" class="rounded-circle mr-2" style="width: 40px" alt="">
                                    <a class="profile_modal_users_list"  href="/profile/{{ $liker_user->id }}">
                                        {{ $liker_user->username }}
                                    </a>
                                </div>     
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
    {{-- end bootstrap modal --}}
@endsection
