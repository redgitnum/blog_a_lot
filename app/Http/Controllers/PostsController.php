<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->withCount('comments')->with('user', 'categories')->paginate(10);
        return view('home', [
            'posts' => $posts
        ]);
    }

    public function category($category)
    {
        $posts = Post::whereHas('categories', function($query) use ($category) {
            $query->where('name', '=', $category);
        })->withCount('comments')->with('user', 'categories')->paginate(10);
        return view('home', [
            'posts' => $posts,
            'category' => $category
        ]);
    }
}
