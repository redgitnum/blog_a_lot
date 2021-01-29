<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\Post;
use App\Models\User;
use App\Models\Vote;
use App\Models\Comment;
use App\Models\Category;
use App\Rules\PasswordCheck;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\QueryException;

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
        return view('auth.Dashboard', [
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
        }])->paginate(10, ['*'], 'comments');
        $votes = Vote::latest()->where('user_id', $id)->with(['post' => function($q) {
            $q->select('id', 'title');
        }])->paginate(10, ['*'], 'votes');
        return view('auth.Dashboard', [
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

    public function deletePost($id)
    {
        if(Post::find($id)->user_id === auth()->id()){
            Post::find($id)->delete();
            return back();
        } else {
            abort(403);
        }
    }

    public function editPost($id)
    {
        if(Post::find($id)->user_id === auth()->id()){
            return view('CreatePost', [
                'categories' => Category::get(),
                'post' => Post::with(['categories'])->find($id)
            ]);
        } else {
            abort(403);
        }
    }

    public function updatePost(Request $request, $id)
    {
        if(Post::find($id)->user_id === auth()->id()){

            $this->validate($request, [
                'title' => 'required|max:255',
                'categories' => 'required|array|min:1|max:5',
                'body' => 'required'
            ]);
            try{
                Post::find($id)->update([
                    'title' => $request->title,
                    'user_id' => auth()->id(),
                    'body' => $request->body,
                ]);
                $cats = [];
                foreach ($request->categories as $cat) {
                    $cats[] = Category::select('id')->where('name', $cat)->value('id');
                }
                Post::find($id)->categories()->detach();
                Post::find($id)->categories()->attach($cats);
    
    
            } catch(QueryException $exception){
                return back()->with('status', $exception->getMessage());
            }
            return redirect()->route('dashboard');
        } else {
            abort(403);
        }
    }

    public function editComment(Request $request,  $id)
    {
        $this->authorize('update', Comment::find($id));

        $this->validate($request, [
            'body' => 'required'
        ]);

        try{
            Comment::find($id)->update([
                'body' => $request->body,
            ]);
        } catch(QueryException $exception){
            if($exception->getCode() === '23000'){
                return back()->with('status', 'Invalid input');
            }
        }

        return back();
    }

    public function deleteComment($id)
    {
        $this->authorize('update', Comment::find($id));
        Comment::find($id)->delete();

        return back();
    }
}
