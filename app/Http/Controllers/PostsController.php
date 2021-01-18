<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->with('user', 'comments')->paginate(10);
        return view('home', [
            'posts' => $posts
        ]);
    }
}
