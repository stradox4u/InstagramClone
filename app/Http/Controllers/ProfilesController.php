<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Cache;

class ProfilesController extends Controller
{
    public function show(User $user) {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;

        //dd($follows);
        $postCount = Cache::remember(
            'count.posts' . $user->id,
            now()->addSeconds(30),
            function() use($user) {
                return $user->posts->count();
            }
        );
        $followersCount = Cache::remember(
            'count.followers' . $user->id,
            now()->addSeconds(30),
            function() use($user) {
                return $user->profile->followers->count();
            }
        );
        $followingCount = Cache::remember(
            'count.following' . $user->id,
            now()->addSeconds(30),
            function() use($user) {
                return $user->following->count();
            }
        );

        return view('profiles.index', compact('user', 'follows', 'postCount', 'followersCount', 'followingCount'));
    }

    public function edit(User $user) {
        $this->authorize('update', $user->profile);

        return view('profiles.edit', compact('user'));

    }

    public function update(User $user) {

        $this->authorize('update', $user->profile);

        $data = request()->validate([
            'title' => 'required',
            'bio' => 'required',
            'url' => 'url',
            'image' => '',
        ]);

        
        if (request('image')) {
            $imagePath = request('image')->store('profile', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(900, 900);
            $image->save();

            $imageArray = ['image' => $imagePath];
        }

        auth()->user()->profile->update(array_merge(
            $data, 
            $imageArray ?? []
        ));

        return redirect("/profile/{$user->id}");

    }

    public function destroy(User $user) 
    {
        //Delete all posts
        $allPosts = $user->posts->all();

        foreach($allPosts as $post) 
        {
            $imagePath = '../storage/app/public/' . $post->image;
                
            @unlink($imagePath);

            $post->delete();
        }
        //Delete Profile Image from Filesystem
        if($user->profile->image !== null)
        {
            $profileImagePath = '../storage/app/public/' . $user->profile->image;
            @unlink($profileImagePath);
        }
        //Delete User Profile and User Table Entries
        $user->profile->delete();
        $user->delete();
        
        return redirect('/');
        
    }
}
