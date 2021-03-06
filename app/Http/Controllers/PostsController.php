<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use App\Models\Category;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['comment', 'vote']);
    }

    public function index($sort = null)
    {
        if($sort === null || $sort ==='mostvotes'){
            $posts = Post::withCount(['comments', 'votes'])->orderBy($sort ? 'votes_count' : 'created_at', 'desc')->with(['user' => function($q) {
                $q->select('id', 'name');
            }, 'categories', 'votes'])->paginate(10);
            return view('Home', [
                'posts' => $posts,
                'sort' => $sort               
                ]);
        }
        return redirect(route('home'));
    }

    public function category($category, $sort = null)
    {
        if($sort === null || $sort ==='mostvotes'){
            $posts = Post::whereHas('categories', function($query) use ($category) {
                $query->where('name', '=', $category);
            })->withCount(['comments', 'votes'])->orderBy($sort ? 'votes_count' : 'created_at', 'desc')->with('user', 'categories', 'votes')->paginate(10);
            return view('Home', [
                'posts' => $posts,
                'category' => $category,
                'sort' => $sort
            ]);
        }
        return redirect(route('home.category', $category));

    }

    public function search(Request $request)
    {
        $this->validate($request, [
            'query' => 'required|min:3'
        ]);
        $posts = Post::latest()->where('title', 'LIKE', '%'.$request->query('query').'%')->withCount(['comments', 'votes'])->with(['user' => function($q) {
            $q->select('id', 'name');
        }, 'categories', 'votes'])->paginate(10)->withQueryString();
        return view('Home', [
            'posts' => $posts,
            'query' => $request->query('query')
            ]);
    }

    public function post($id)
    {
        $post = Post::where('id', $id)->withCount('votes')->with(['comments' => function($q) {
            $q->orderBy('created_at', 'desc');
        }, 'comments.user' => function($q) {
            $q->select('id', 'name');
        }, 'categories', 'user'  => function($q) {
            $q->select('id', 'name')->withCount(['posts', 'comments', 'votes']);
        }])->first();
        if(!isset($post)){
            abort(404);
        }
        return view('PostPage', [
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

    public function vote($id)
    {
        $votes = Vote::where([
            ['user_id', auth()->id()],
            ['post_id', $id]
            ]);
        if($votes->get()->isEmpty())
            {
                $vote = new Vote([
                    'post_id' => $id,
                    'user_id' => auth()->id()
                ]);
                $vote->save();
            } else {
                $votes->delete();
        }
        
        return redirect(url()->previous());
    }
}
