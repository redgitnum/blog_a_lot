<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only('comment');
    }

    public function index()
    {
        $posts = Post::latest()->withCount('comments')->with(['user' => function($q) {
            $q->select('id', 'name');
        }, 'categories'])->paginate(10);
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

    public function post($id)
    {
        $post = Post::where('id', $id)->with(['comments' => function($q) {
            $q->orderBy('created_at', 'desc');
        }, 'comments.user' => function($q) {
            $q->select('id', 'name');
        }, 'categories', 'user'  => function($q) {
            $q->select('id', 'name');
        }])->first();
        return view('postpage', [
            'post' => $post
        ]);
    }

    public function comment(Request $request, $id)
    {
        $this->validate($request, [
            'body' => 'required'
        ]);

        try{
            Comment::create([
                'body' => $request->body,
                'user_id' => auth()->id(),
                'post_id' => $id
            ]);
        } catch(QueryException $exception){
            if($exception->getCode() === '23000'){
                return back()->with('status', 'Invalid input');
            }
        }

        return back();
    }
}
