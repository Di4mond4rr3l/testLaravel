<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function posts(){
        $posts = Post::with('user')->get();
        return view('posts', ['posts'=>$posts]);
    }

    public function post($id){
        $post = Post::with('user')->find($id);
        return view('post', ['post'=>$post]);
    }
}
