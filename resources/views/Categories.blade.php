@extends('_layouts.app')
@section('content')


<div class="flex flex-col items-center flex-grow">
    <h1 class="text-2xl mt-4 tracking-wide">Categories</h1>
    <div class="flex flex-wrap justify-center my-4 w-11/12 sm:w-10/12 lg:w-8/12 xl:w-7/12">
        @foreach ($categories as $cat)
        <div class="bg-blue-400 rounded-lg p-1 px-3 text-lg text-white m-1">
            <a href="{{ route('home.category', $cat->name) }}">
                {{ $cat->name }} - {{ $cat->posts() }}
            </a>
        </div>
        @endforeach
    </div>
</div>
@endsection