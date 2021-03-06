<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class CreatePostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    public function index()
    {
        return view('CreatePost', [
            'categories' => Category::get()
        ]);
    }

    public function create(Request $request, Auth $auth)
    {
        
        $this->validate($request, [
            'title' => 'required|max:255|min:10',
            'categories' => 'required|array|min:1|max:5',
            'body' => 'required|min:500'
        ]);
        try{
            $post = new Post([
                'title' => $request->title,
                'user_id' => $auth::id(),
                'body' => $request->body,
            ]);
            $cats = [];
            foreach ($request->categories as $cat) {
                $cats[] = Category::select('id')->where('name', $cat)->value('id');
            }
            $post->save();
            $post->categories()->attach($cats);


        } catch(QueryException $exception){
            return back()->with('status', $exception->getMessage());
        }
        return redirect()->route('home');
    }
}
