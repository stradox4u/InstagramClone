@extends('layouts.app')

@section('content')
<div class="container">
<form action="/profile/{{ $user->id }}" enctype="multipart/form-data" method="post">

@csrf
@method('PATCH')

<div class="row">
    <div class="col-8 offset-2">
        <div class="row">
            <h2>Edit Profile</h2>
    
        </div>
        <div class="form-group row">
            <label for="title" class="col-md-4 col-form-label">Title</label>

            
                <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') ?? $user->profile->title }}" required autocomplete="title" autofocus>

                @error('title')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            
        </div>

        <div class="form-group row">
            <label for="bio" class="col-md-4 col-form-label">Bio</label>

            
                <input id="bio" type="text" class="form-control @error('bio') is-invalid @enderror" name="bio" value="{{ old('bio') ?? $user->profile->bio }}" required autocomplete="bio" autofocus>

                @error('bio')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            
        </div>

        <div class="form-group row">
            <label for="url" class="col-md-4 col-form-label">URL</label>

            
                <input id="url" type="text" class="form-control @error('url') is-invalid @enderror" name="url" value="{{ old('url') ?? $user->profile->url }}" required autocomplete="url" autofocus>

                @error('url')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            
        </div>
        <div class="row">
            <label for="image" class="col-md-4 col-form-label">Profile Image</label>

            <input type="file" class="form-control-file" id="image" name="image">

            @error('image')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        </div>
        <div class="row d-flex justify-content-between">
            <button class="btn btn-primary mt-4">Save Profile</button>
        </div>
    </div>
</div>
</form>



    <div class="col-8 offset-2">
        <a href="/get/{{ $user->id }}" class="btn btn-primary mt-4 btn-block">Delete Profile</a>
    </div>

</div>
@endsection
