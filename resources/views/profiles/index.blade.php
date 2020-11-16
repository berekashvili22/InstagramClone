@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-5">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100" alt="">
        </div>
        <div class="col-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center">
                    <div class="h4 mr-4">{{ $user->username }}</div>

                    @if ($user->profile->id != auth()->user()->id)
                        <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}" class="pb-1"></follow-button>
                    @endif
                    
                </div>

                @can('update', $user->profile)
                    <a href="/p/create">Add New Post</a>
                @endcan
            </div>
            @can('update', $user->profile)
                <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
            @endcan
            <div class="d-flex mt-1">
                <div class="pr-5"><strong class="pr-1">{{ $user->posts->count() }}</strong>post</div>
                <div class="pr-5"><strong class="pr-1">{{ $user->profile->followers->count() }}</strong>
                    <!-- Button trigger modal -->
                    <button type="button" class="text-nowrap" style="border: none;
                    background-color: inherit; outline: none;" data-toggle="modal" data-target="#followers-modal">
                        followers
                    </button>
                </div>
                <div class="pr-5"><strong class="pr-1">{{ $user->following->count() }}</strong>
                    <!-- Button trigger modal -->
                    <button type="button" class="text-nowrap" style="border: none;
                    background-color: inherit; outline: none;" data-toggle="modal" data-target="#following-modal">
                        following
                    </button>
                </div>
            </div>
            <div class="pt-4 font-weight-bold">
                {{ $user->profile->title }}
            </div>
            <div>
                {{ $user->profile->description }}
            </div>
            <div>
                <a href="#">{{ $user->profile->url }}</a>
            </div>
        </div>
    </div>
    <div class="row pt-5">
        @foreach ($user->posts as $post)
        <div class="col-4 pb-4">
            <a href="/p/{{ $post->id }}">
                <img src="/storage/{{ $post->image }}" class="w-100" alt="">
            </a>
        </div> 
        @endforeach 
    </div>
    {{-- bootstrap modal for following --}}  
            <!-- Modal -->
            <div class="modal fade" id="following-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <div class="d-flex justify-content-center w-100">
                        <h5 class="modal-title" id="exampleModalLongTitle">Following</h5>
                    </div>    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="scrollbar scrollbar-lady-lips">
                        <div class="force-overflow">
                            <div class="modal-body">
                                @foreach ($following_list as $following_user)
                                <div class="col-1 d-flex align-items-center">
                                    <img src="{{ $following_user->profile->profileImage() }}" class="rounded-circle mr-2" style="width: 40px" alt="">
                                    <p class="font-weight-bold pt-3">{{ $following_user->username }}</p>
                                </div>   
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            </div>
    {{-- end bootstrap modal --}}
    {{-- bootstrap modal for followers --}}  
            <!-- Modal -->
            <div class="modal fade" id="followers-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                    <div class="d-flex justify-content-center w-100">
                        <h5 class="modal-title" id="exampleModalLongTitle">Followers</h5>
                    </div>    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                    <div class="modal-body">
                        @foreach ($followers_list as $following_user)
                        <div class="col-1 d-flex align-items-center">
                            <img src="{{ $following_user->profile->profileImage() }}" class="rounded-circle mr-2" style="width: 40px" alt="">
                            <p class="font-weight-bold pt-3">{{ $following_user->username }}</p>
                        </div>   
                        @endforeach
                    </div>
                </div>
                </div>
            </div>
    {{-- end bootstrap modal --}}
</div>

@endsection
