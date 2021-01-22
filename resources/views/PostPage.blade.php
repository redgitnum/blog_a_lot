@extends('_layouts.app')
@section('content')


<div class="flex flex-col items-center flex-grow">
    <div class="w-11/12 sm:w-10/12 lg:w-8/12 xl:w-7/12 mt-4 flex">
        <h1 class="text-md text-gray-500 ml-3 px-3">
            <a href="{{ route('home') }}"> &#8592; back </a>
            / {{ $post->title }}</h1>
    </div>
    <div class="w-11/12 sm:w-10/12 lg:w-8/12 xl:w-7/12 p-3">
        <x-post :post="$post"/>
        <div class="border-t border-b px-6 py-4 flex justify-between items-center mt-4 bg-white shadow rounded-md rounded-b-none border-gray-200">
            <div class="text-gray-500 font-mono select-none">
                {{ $post->comments->count() ?? 'No' }} {{ Str::plural('Comment', $post->comments->count()) }}
            </div>
        </div>
            <ul class="px-6 py-4 flex flex-col bg-white shadow  border-gray-200">
                @isset($post->comments)
                    @foreach($post->comments as $comment)
                    <li class="bg-gray-50 pb-2 mb-2 shadow-lg border rounded w-full" id="{{ 'comment-'.$comment->id }}">
                        <div class="bg-blue-50 px-2 pt-2 text-xs pb-2 border-b border-gray-500">
                            <a href="" class="text-green-600 text-sm">{{ $comment->user->name }}</a> -  
                            <a href="#{{ 'comment-'.$comment->id }}" class="text-blue-500">{{ $comment->created_at->diffForHumans()}}</a> said:
                        </div>
                        <div class="px-4 py-3 text-gray-700">
                            {!! nl2br(e($comment->body)) !!}
                        <div>
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
                <div class="px-6 py-4 mt-2 flex flex-col border-t-2 justify-between bg-white shadow  border-gray-200">
                    <h1 class="text-lg">
                        Write a comment    
                    </h1>
                    <form class="w-full p-3" action="{{ route('post.comment', ['id' => $post->id]) }}" method="POST">
                        @csrf
                        @error('body')
                        <div class="text-red-500 mb-2 text-sm">{{ $message }}</div>
                        @enderror
                        <textarea name="body" rows="3" class="resize-none w-full bg-gray-100 shadow p-2 rounded-t" placeholder="Write something..."></textarea>
                        <button class="p-2 w-full transition-all bg-green-300 hover:bg-green-500 active:bg-green-400 shadow text-white uppercase font-bold rounded-b" type="submit">Add Comment</button>
                    </form>
                </div>
            @endauth
            @guest
            <div class="px-6 py-4 mt-2 flex flex-col border-t-2 justify-between bg-white shadow  border-gray-200">
                <h1 class="text-lg">
                    <a href="{{ route('login') }}" class="text-blue-500">Login</a> or <a href="{{ route('register') }}" class="text-red-500">register</a> to be able to comment  
                </h1>
            </div>
            @endguest
    </div>
</div>
@endsection