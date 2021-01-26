@extends('_layouts.app')
@section('content')

<script defer>
    let limit = 5;
    window.onload = function() {        
        let checkboxes = document.querySelectorAll('input[type=checkbox]');
        checkboxes.forEach((elTop) => {
            elTop.addEventListener('click', function() {
                let count = 0;
                checkboxes.forEach((elCheck) => {
                    if(elCheck.checked) count++
                })
                if(count > 4){
                    checkboxes.forEach((elDisable) =>{
                        if(!elDisable.checked) elDisable.disabled = true
                    })
                } else {
                    checkboxes.forEach((elEnable) =>{
                        elEnable.disabled = false
                    })
                }
            })
        })
    }
</script>

<style>
    input[type=checkbox]:checked~span{
        background-color: #60A5FA;
    }
    input[type=checkbox]:checked~label{
        color: white;
    }
</style>
    <div class="flex flex-col items-center w-full flex-grow">
        <h1 class="text-2xl mt-4 tracking-wide">Create New Post</h1>
        <div class="flex flex-col items-center w-full sm:w-10/12 lg:w-8/12 xl:w-6/12 mt-3 mb-1">
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
                    class="w-full focus:ring-4 focus:ring-green-300 ring-2 ring-blue-300 p-4 text-xl rounded-md text-gray-700 shadow" 
                    type="text" name="title" value="{{ old('title') }}" placeholder="Post Title">
                        @error('categories')
                            <div class="text-red-500 my-2 text-sm">{{ $message }}</div>
                        @enderror
                    <div class=" flex flex-wrap py-2">
                        @foreach ($categories as $category)
                        <div class="select-none relative flex flex-wrap items-center bg-blue-300 rounded-xl px-2 py-1 m-0.5 overflow-hidden" style="">
                            <input class="z-10 appearance-none bg-white checked:bg-green-500 disabled:opacity-25 w-4 h-4 border-4 border-white rounded" type="checkbox" name="categories[]" value="{{ $category->name }}" id="{{ $category->name }}">
                            <span class="left-0 absolute w-full h-full"></span>
                            <label class="z-10 text-gray-600 uppercase font-mono px-2" for="{{ $category->name }}">{{ $category->name }}</label>
                        </div>
                        @endforeach
                        <div class="w-full mx-2 mt-1 flex justify-end">
                            <span class="text-right px-2 py-0.5 font-mono text-xs uppercase text-gray-600 border border-gray-400 rounded-xl">&#9432; You can choose maximum 5 categories</span>
                        </div>
                    </div>
                        @error('body')
                            <div class="text-red-500 mb-2 text-sm">{{ $message }}</div>
                        @enderror
                    <textarea class="w-full p-4 text-lg mb-4 rounded-md focus:ring-4 focus:ring-green-300 ring-2 ring-blue-300 shadow" placeholder="Post content" name="body" cols="50" rows="10">{{ old('body') }}</textarea>
                    <button class="p-4 w-full transition-all bg-green-400 hover:bg-green-500 active:bg-green-400 shadow text-white uppercase font-bold rounded-md" type="submit">Add Post</button>
                </div>
            </form>
        </div>
    </div>
@endsection

