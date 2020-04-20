<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\User;

class PostsController extends Controller
{

    public function __construct() {
        $this->middleware('auth');

    }

    public function index() {
        //dd(User::all()->pluck('id'));
        $data = auth()->user()->following()->pluck('profiles.user_id');
        if($data->isEmpty()) {
            $users = User::all()->pluck('id');
        }else { 
            $users = $data;
        }
        
        $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        
        return view('posts.index', compact('posts'));

    }

    public function create() {
        return view('posts.create');
    }

    public function store() {

        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required', 'image'],
        ]);

        $imagePath = request('image')->store('uploads', 'public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
        $image->save();

        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);
            //dd(request()->all());
        return redirect('/profile/' . auth()->user()->id);

    }

    public function show(\App\Post $post) {
        return view('posts.show', compact('post'));
    }

    public function destroy(\App\Post $post) {
        $post->delete();
        return redirect("/profile/{$post->user->id}");
        
    }
    
}
