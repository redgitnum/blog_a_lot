@extends('_layouts.app')
@section('content')
    
@php
    // dd($posts)
@endphp
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

    function showSearch(e){
        e.classList.toggle('hidden');
    }
</script>

    <div class="flex flex-col items-center flex-grow">
        <div class="flex items-center fixed top-2 sm:top-6 left-0 bg-white shadow rounded-full rounded-l-none text-xl">
            <button type="button" onclick="showSearch({{ 'search_input' }})" class="p-4 focus:outline-none hover:text-gray-500">
                &#128270;
            </button>
            <form action="{{ route('post.search') }}">
                <div class="hidden pr-6 flex items-center" id="search_input">
                    <input type="text" name="query" class="w-full rounded-lg p-2 bg-gray-100" placeholder="min 3 characters" min="3">
                    <button type="submit" 
                    class="bg-blue-300 hover:bg-blue-400 hover:text-white active:bg-blue-300 transition focus:outline-none p-2 rounded-lg ml-2">
                    Go
                </button>
            </div>
            </form>
        </div>
        @if(isset($query))
        <div class="items-baseline w-11/12 sm:w-10/12 lg:w-8/12 xl:w-7/12 px-4 mt-2">
            <div class="text-xl border-b text-blue-500">
                {{ $posts->total() }} Search results for: {{ $query }}
            </div>
            <div class="text-xs uppercase text-gray-500">posts</div>
        </div>
        @else
        <div class="w-11/12 sm:w-10/12 lg:w-8/12 xl:w-7/12 flex p-1 
        font-mono text-gray-600 text-sm mt-3 mb-1">
            <a href="{{ isset($category) ? route('home.category', $category) : route('home') }}" class="pl-3 pr-6 @empty($sort) font-bold @endempty">latest</a>&#183;
            <a href="{{ isset($category) ? route('home.category', [$category, 'mostvotes']) : route('home', 'mostvotes') }}" class="px-6 @isset($sort) font-bold @endisset">most votes</a>
        </div>
        @endif

        @isset($category)
        <div class="items-baseline w-11/12 sm:w-10/12 lg:w-8/12 xl:w-7/12 px-4 mt-1">
            <div class="text-xl border-b uppercase text-blue-500">
                {{ $category }}
            </div>
            <div class="text-xs uppercase text-gray-500">posts</div>
        </div>
        @endisset
        <div class="w-11/12 sm:w-10/12 lg:w-8/12 xl:w-7/12 p-3">
            @foreach ($posts as $post)
                <x-post :post="$post"/>
                <a href="{{ route('post', ['id' => $post->id]) }}" class="select-none border-t px-6 py-4 flex justify-between items-center mb-4 bg-white shadow rounded-md rounded-t-none border-gray-200">
                    <div class="text-gray-500 font-mono">
                        {{ $post->comments_count }} Comments 
                    </div>
                    <div class="text-sm uppercase font-mono text-gray-600 ">
                        continue reading>>
                    </div>
                </a>
            @endforeach
            @if(!$posts->count())
            <div class="w-full bg-white shadow rounded-md rounded-b-none border-gray-400">
                <div class="text-lg text-gray-500 flex items-center justify-between p-4">
                    No posts @if(isset($query)) found  @else with that category @endif :(
                </div>
            </div>
            @endif

        </div>
        <div class="px-1">
            {{ $posts->links() }}
        </div>
    </div>
@endsection