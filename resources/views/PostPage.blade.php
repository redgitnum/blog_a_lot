@extends('_layouts.app')
@section('content')

<script defer>
    window.onload = function(){
        if(sessionStorage.getItem('scrollPos') && (document.referrer == window.location.href)){
            window.scrollTo(0, sessionStorage.getItem('scrollPos'))
            sessionStorage.clear()
        }
    }
    window.onscroll = function(){
        sessionStorage.setItem('scrollPos', window.scrollY);
    }

    function showEditComment(e, parent){
        e.classList.toggle('hidden')
        parent.innerText === 'Edit' ? parent.innerText = 'Cancel' : parent.innerText = 'Edit';
        parent.classList.toggle('bg-green-500')
        parent.classList.toggle('hover:bg-green-600')
        parent.classList.toggle('active:bg-green-500')
        parent.classList.toggle('bg-blue-500')
        parent.classList.toggle('hover:bg-blue-600')
        parent.classList.toggle('active:bg-blue-500')
    }
</script>


<div class="flex flex-col items-center">
    <div class="w-11/12 sm:w-10/12 lg:w-8/12 xl:w-7/12 mt-4 flex">
        <h1 class="text-md text-gray-500 ml-3 px-3">
            <a href="{{ route('home') }}"> &#8592; home </a>
            / {{ $post->title }}
        </h1>
    </div>
    <div class="flex flex-wrap w-11/12 sm:w-10/12 lg:w-8/12 xl:w-7/12 p-3">
        <x-post :post="$post"/>
        <div class="h-full w-full border-t lg-border-none lg:w-2/12 static lg:absolute right-1 xl:right-10">
            <div class="sticky px-6 lg:px-2 top-0 bg-gray-50 p-2 rounded-b lg:rounded shadow">
                <p class="font-mono uppercase text-sm">About author</p>
                <a href="{{ route('user', ['id'=>$post->user->id]) }}" class="font-bold text-blue-600">{{ $post->user->name }}</a>
                <p>{{ $post->user->posts_count }} &#10002; posts</p>
                <p>{{ $post->user->comments_count }} &#9993; comments</p>
                <p>{{ $post->user->votes_count }} &#10026; total votes</p>
            </div>
        </div>
        <div class="w-full border-t border-b px-6 py-4 flex justify-between items-center mt-4 bg-white shadow rounded-md rounded-b-none border-gray-200">
            <div class="text-gray-500 font-mono select-none">
                {{ $post->comments->count() ?? 'No' }} {{ Str::plural('Comment', $post->comments->count()) }}
            </div>
        </div>
        <ul class="w-full px-6 py-4 flex flex-col bg-white shadow border-gray-200">
            @isset($post->comments)
                @foreach($post->comments as $comment)
                <li class="bg-gray-50 pb-2 mb-2 shadow border rounded w-full" id="{{ 'comment-'.$comment->id }}">
                    <div class="bg-blue-50 px-2 pt-2 text-xs pb-2 border-b border-gray-500 flex justify-between">
                        <div>
                            <a href="{{ route('user', ['id'=> $comment->user->id]) }}" class="text-green-600 text-sm">{{ $comment->user->name }}</a> -  
                            <a href="#{{ 'comment-'.$comment->id }}" class="text-blue-500">{{ $comment->created_at->diffForHumans()}}</a> said:
                        </div>
                        <div class="flex items-center">
                            @can('update', $comment)
                                <button type="button"
                                onclick="showEditComment({{ 'comment'.$comment->id }}, this)"
                                class="bg-green-500 hover:bg-green-600 active:bg-green-500 rounded p-1 mr-1 text-white">
                                Edit
                                </button>
                                <form action="{{ route('comment.delete', ['id' => $comment->id]) }}" method="POST" class="flex my-1 items-center mr-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                    class="bg-red-500 hover:bg-red-600 active:bg-red-500 rounded p-1 mr-1 text-white">
                                    Delete
                                    </button>
                                </form>
                            @endcan
                            <div>
                                {{ $comment->created_at }}
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 text-gray-700">
                        {!! nl2br(e($comment->body)) !!}
                    <div>
                        @can('update', $comment)
                            <div class="hidden mt-2 border-t border-gray-400 pt-1" id="{{ 'comment'.$comment->id }}">
                                @error('body')
                                <div class="text-red-500 my-1 text-sm">{{ $message }}</div>
                                @enderror
                                <form action="{{ route('comment.edit', ['id' => $comment->id]) }}" method="POST">
                                    @csrf
                                    <textarea name="body" rows="3" class="resize-none w-full bg-gray-100 shadow p-2 rounded-t" 
                                    placeholder="Write something...">{{ $comment->body }}</textarea>
                                    <button class="p-2 w-full transition-all bg-green-400 hover:bg-green-500
                                    active:bg-green-400 shadow text-white uppercase font-bold rounded-b" 
                                    type="submit">
                                    Edit Comment
                                    </button>
                                </form>
                            </div>
                        @endcan
                </li>
                @endforeach
            @endisset
            @if($post->comments->isEmpty())
            <div class="text-left">
                Be the first to comment
            </div>
            @endempty
        </ul>
        @auth     
            <div class="w-full px-6 py-4 mt-2 flex flex-col border-t-2 justify-between bg-white shadow  border-gray-200">
                <h1 class="text-lg">
                    Write a comment    
                </h1>
                <form class="w-full p-3" action="{{ route('post.comment', ['id' => $post->id]) }}" method="POST">
                    @csrf
                    @error('body')
                    <div class="text-red-500 mb-2 text-sm">{{ $message }}</div>
                    @enderror
                    <textarea name="body" rows="3" class="resize-none w-full bg-gray-100 shadow p-2 rounded-t" placeholder="Write something..."></textarea>
                    <button class="p-2 w-full transition-all bg-green-400 hover:bg-green-500 active:bg-green-400 shadow text-white uppercase font-bold rounded-b" type="submit">Add Comment</button>
                </form>
            </div>
        @endauth
        @guest
        <div class="w-full px-6 py-4 mt-2 flex flex-col border-t-2 justify-between bg-white shadow  border-gray-200">
            <h1 class="text-lg">
                <a href="{{ route('login') }}" class="text-blue-500">Login</a> or <a href="{{ route('register') }}" class="text-red-500">register</a> to be able to comment  
            </h1>
        </div>
        @endguest
    </div>
</div>
@endsection