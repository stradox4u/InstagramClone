@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{ $post->image }}" alt="" class="w-100">
        </div>
        <div class="col-4">
            <div class="d-flex align-items-center">
            <div class="pr-3">
                <img src="{{ $post->user->profile->profileImage() }}" alt="" 
                style="max-width: 45px;" class="w-100 rounded-circle">
            </div>
            <div>
            <div class="font-weight-bold d-flex justify-content-between">
                <a href="/profile/{{ $post->user->id }}">
                    <span class="text-dark">{{ $post->user->username }}</span>
                </a>
                <follow-button user-id="{{$post->user->id}}" class="pl-3"></follow-button>
            </div>
            </div>
                            
            </div>
            <hr>
            <div>
            @can('delete', $post->user->profile)
            <form action="/posts/{{ $post->id }}" enctype="multipart/form-data" method="post">
            @csrf
            @method('DELETE')
                <button class="btn btn-sm btn-light p-2">DELETE POST</button>
            </form>
            @endcan
               </div> 
            <hr>
            <p><span class="font-weight-bold pr-2">
                <a href="/profile/{{ $post->user->id }}">
                    <span class="text-dark">{{ $post->user->username }}</span>
                </a>
                </span>{{ $post->caption }}
            </p>
        </div>
    </div>
</div>
@endsection
