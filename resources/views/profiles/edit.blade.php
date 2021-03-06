@extends('layouts.app')

@section('content')
<div class="container">
    <form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="POST">
        @csrf
        @method('PATCH')
        <div class="row">
            <div class="col-8 offset-2">
                <div class="row">
                    <h2>Edit Profile</h2>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label"><strong>Title</strong></label>
                    <input  id="title"
                            type="text"
                            name="title"
                            class="form-control @error('title') is-invalid @enderror" 
                            title="title" value="{{ old('title') ?? $user->profile->title }}"  
                            autocomplete="title" autofocus>
                    @error('title')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="description" class="col-md-4 col-form-label"><strong>Description</strong></label>
                    <input  id="description"
                            type="text"
                            name="description"
                            class="form-control @error('description') is-invalid @enderror" 
                            value="{{ old('description') ?? $user->profile->description }}"  
                            autocomplete="description" autofocus>
                    @error('description')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label"><strong>Url</strong></label>
                    <input  id="url"
                            type="text"
                            name="url"
                            class="form-control @error('url') is-invalid @enderror" 
                            url="url" value="{{ old('url') ?? $user->profile->url }}"  
                            autocomplete="url" autofocus>
                    @error('url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="row">
                    <label for="image" class="col-md-4 col-form-label"><strong>Profile Image</strong></label>
                    <input type="file" class="form-control-file" id="image" name="image">
                    @error('image')
                        <strong>{{ $message }}</strong>
                    @enderror
                </div>
                    <div class="row mt-5">
                        <button class="btn btn-primary">Update Profile</button>
                    </div>  
            </div>
          </div>
       </form>
</div>
@endsection

