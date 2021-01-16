@extends('_layouts.app')
@section('content')
    <div class="flex flex-col items-center w-full flex-grow">
        <h1 class="text-2xl mt-4 tracking-widest">LOGIN</h1>
        @if(session('status'))
            <div class="text-red-500 mb-2 text-sm">
                {{ session('status') }}
            </div>
            @endif
        <form action="{{ route('login') }}" method="POST" class="w-96">
            @csrf
            <div class="flex flex-col justify-center 
            items-center p-6 bg-white rounded-lg m-4 shadow-xl">
                    @error('email')
                        <div class="text-red-500 mb-2 text-sm">{{ $message }}</div>
                    @enderror
                <input class="w-full p-4 text-lg mb-4 rounded-md bg-blue-400 placeholder-white text-white shadow" type="email" name="email" placeholder="E-mail">
                    @error('password')
                        <div class="text-red-500 mb-2 text-sm">{{ $message }}</div>
                    @enderror
                <input class="w-full p-4 text-lg mb-4 rounded-md bg-blue-400 placeholder-white text-white shadow" type="password" name="password" placeholder="Password">
                <button class="p-3 w-full text-2xl bg-green-500 shadow text-white uppercase font-bold rounded-md" type="submit">Login</button>
            </div>
        </form>
    </div>
@endsection