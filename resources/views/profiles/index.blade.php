@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-3 p-4">
            <img src="{{ $user->profile->profileImage() }}" class="rounded-circle w-100" />
        </div>
        <div class="col-9 pt-4">
            <div class="d-flex justify-content-between align-items-baseline pb-3">
                <div class="d-flex justify-content-between align-items-center">
                    <h1 class="pr-3">{{ $user->username }}</h1>

                    <follow-button user-id="{{$user->id}}" follows="{{ $follows }}"></follow-button>
                </div>

            @can('update', $user->profile)
                <a href="/p/create" class="btn btn-primary p-2 align-self-center">Add New Post</a>
            @endcan    
            
            </div>
            @can('update', $user->profile)
               <div class="d-flex justify-content-between">
                    <a href="/profile/{{ $user->id }}/edit">Edit Profile</a>
                    <a href="/search">Search For Users</a>
               </div>
            @endcan

            <div class="d-flex">
            <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
            <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>
            <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>
            <p>{{ $user->profile->bio }}</p>
            </div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
        </div>
    </div>

    <div class="row pt-4">
        @foreach($user->posts as $post) 
            <div class="col-4 pb-4">
                <a href="/p/{{ $post->id }}">
                    <img src="/storage/{{ $post->image }}" alt="" style="width: 300px;">
                </a>
            </div>
        @endforeach
        
    </div>
    
</div>
@endsection
