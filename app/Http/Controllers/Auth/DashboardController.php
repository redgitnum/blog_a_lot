<?php

namespace App\Http\Controllers\Auth;

use App\Models\Post;
use App\Models\User;
use App\Models\Vote;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'])->only(['index']);
    }

    public function index()
    {

        $user = User::where('id', auth()->id())->select('id', 'name', 'created_at')->withCount(['posts', 'votes', 'comments', 'hasVotes'])->first();
        $posts = Post::latest()->where('user_id', auth()->id())->with(['categories'])->withCount(['votes'])->paginate(10, ['*'], 'posts');
        $comments = Comment::latest()->where('user_id', auth()->id())->with(['post' => function($q) {
            $q->select('id', 'title');
        }])->paginate(3, ['*'], 'comments');
        $votes = Vote::latest()->where('user_id', auth()->id())->with(['post' => function($q) {
            $q->select('id', 'title');
        }])->paginate(10, ['*'], 'votes');
        return view('auth.dashboard', [
            'user' => $user,
            'posts' => $posts,
            'comments' => $comments,
            'votes' => $votes,
        ]);
    }

    public function user($id)
    {
        $user = User::where('id', $id)->select('id', 'name', 'created_at')->withCount(['posts', 'votes', 'comments', 'hasVotes'])->first();
        if(!isset($user)){
            abort(404);
        }
        $posts = Post::latest()->where('user_id', $id)->with(['categories'])->withCount(['votes'])->paginate(10, ['*'], 'posts');
        $comments = Comment::latest()->where('user_id', $id)->with(['post' => function($q) {
            $q->select('id', 'title');
        }])->paginate(3, ['*'], 'comments');
        $votes = Vote::latest()->where('user_id', $id)->with(['post' => function($q) {
            $q->select('id', 'title');
        }])->paginate(10, ['*'], 'votes');
        return view('auth.dashboard', [
            'user' => $user,
            'posts' => $posts,
            'comments' => $comments,
            'votes' => $votes,
        ]);
    }
}
