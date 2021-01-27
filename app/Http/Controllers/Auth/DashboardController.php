<?php

namespace App\Http\Controllers\Auth;

use App\Models\Post;
use App\Models\User;
use App\Models\Vote;
use App\Models\Comment;
use App\Rules\PasswordCheck;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth'])->only(['index', 'passwordUpdate']);
    }

    public function index()
    {

        $user = User::where('id', auth()->id())->select('id', 'name', 'username', 'created_at')->withCount(['posts', 'votes', 'comments', 'hasVotes'])->first();
        $posts = Post::latest()->where('user_id', auth()->id())->with(['categories', 'votes'])->withCount('votes')->paginate(10, ['*'], 'posts');
        $comments = Comment::latest()->where('user_id', auth()->id())->with(['post' => function($q) {
            $q->select('id', 'title');
        }])->paginate(10, ['*'], 'comments');
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
        $user = User::where('id', $id)->select('id', 'name', 'username', 'created_at')->withCount(['posts', 'votes', 'comments', 'hasVotes'])->first();
        if(!isset($user)){
            abort(404);
        }
        $posts = Post::latest()->where('user_id', $id)->with(['categories', 'votes'])->withCount(['votes'])->paginate(10, ['*'], 'posts');
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

    public function passwordUpdate(Request $request)
    {
       $this->validate($request, [
           'old_password' => ['required', new PasswordCheck],
           'new_password' => ['required', 'confirmed']
       ]);

        try{
            User::find(auth()->id())->update(['password' => Hash::make($request->new_password)]);
        } catch(Exception $e){
            return back()->with('status', 'Password update Failed');
        }

       return back()->with('status', 'Password updated Successfully!');
    }

    public function deleteAccount(Request $request)
    {
        $this->validate($request, [
            'delete_confirmation' => ['required','in:delete']
        ]);
        
        User::find(auth()->id())->delete();
        return redirect()->route('home');
    }
}
