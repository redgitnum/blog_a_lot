@extends('_layouts.app')
@section('content')

    <div class="flex flex-col items-center flex-grow">
        <div class="w-11/12 sm:w-10/12 lg:w-8/12 xl:w-7/12 flex p-1 
        font-mono text-gray-600 text-sm mt-3 mb-1">
            <a href="" class="pl-3 pr-6 font-bold">latest</a>&#183;
            <a href="" class="px-6">most viewed</a>&#183;
            <a href="" class="px-6">most votes</a>
        </div>
        <div class="w-11/12 sm:w-10/12 lg:w-8/12 xl:w-7/12  p-3">
            @foreach ($posts as $post)
                <x-post :post="$post"/>
            @endforeach

        {{ $posts->links() }}
        </div>
    </div>
@endsection