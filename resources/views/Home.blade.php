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
</script>

    <div class="flex flex-col items-center flex-grow">
        <div class="w-11/12 sm:w-10/12 lg:w-8/12 xl:w-7/12 flex p-1 
        font-mono text-gray-600 text-sm mt-3 mb-1">
            <a href="" class="pl-3 pr-6 font-bold">latest</a>&#183;
            <a href="" class="px-6">most votes</a>
        </div>
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
                    No posts with that category :(
                </div>
            </div>
            @endif

        {{ $posts->links() }}
        </div>
    </div>
@endsection