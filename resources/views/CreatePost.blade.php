@extends('_layouts.app')
@section('content')

@php
use App\models\Category;
$categories = Category::get();
@endphp
<script defer>
    function expandSelect(){
        let sel = document.getElementById('select-container');
        if(sel.classList.contains('h-96')){
            sel.classList.remove('h-96')
        } else {
            sel.classList.add('h-96')
        }
    }
</script>
    <div class="flex flex-col items-center w-full flex-grow">
        <h1 class="text-2xl mt-4 tracking-widest">CREATE NEW POST</h1>
        @if(session('status'))
            <div class="text-red-500 my-2 text-sm">
                {{ session('status') }}
            </div>
        @endif
        <form action="{{ route('posts.create') }}" method="POST">
            @csrf
            <div class="flex flex-col justify-center 
            items-center p-6 bg-white  rounded-lg m-4 shadow-xl">
                    @error('title')
                        <div class="text-red-500 mb-2 text-sm">{{ $message }}</div>
                    @enderror
                <input onkeydown="return event.key != 'Enter';" 
                class="w-full p-4 text-lg rounded-md bg-blue-400 placeholder-white text-white shadow" 
                type="text" name="title" value="{{ old('title') }}" placeholder="Title">
                    @error('categories')
                        <div class="text-red-500 my-2 text-sm">{{ $message }}</div>
                    @enderror
                <div class="w-full flex py-2" id="select-container">
                    <button title="Expand/Shrink list" type="button" class="px-2 text-4xl" onclick="expandSelect()">&#8597;</button>
                    <select name="categories[]" multiple
                    class="h-full rounded-md w-8/12 self-start text-lg shadow">
                    @foreach ($categories as $category)
                        <option class="p-1 rounded" value="{{ $category->name }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                    </select>
                    <div class="ml-2 rounded-md bg-green-200 flex flex-col justify-evenly items-center text-center">
                        Ctrl + click for multiple categories
                        <small class="uppercase text-xs font-mono text-gray-600">&#9432; Maximum 5 categories</small>
                    </div>
                </div>
                    @error('body')
                        <div class="text-red-500 mb-2 text-sm">{{ $message }}</div>
                    @enderror
                <textarea class="w-full p-4 text-lg mb-4 rounded-md bg-blue-400 placeholder-white text-white shadow" placeholder="Post content" name="body" cols="50" rows="10">{{ old('body') }}</textarea>
                <button class="p-4 w-full bg-green-500 shadow text-white uppercase font-bold rounded-md" type="submit">Add Post</button>
            </div>
        </form>
    </div>
@endsection

