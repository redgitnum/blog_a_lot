<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">    
    <title>Blog-a-lot</title>
    <style>
        html{
            font-size: 12px
        }
        @media (min-width: 640px) 
        { 
            html{
                font-size: 16px
            }     
        }
}
    </style>
</head>
<body class="bg-gray-100 flex flex-col min-h-screen">
    <header class="flex flex-col items-center">
        <div class="flex justify-between items-center w-full py-4">
            <div class="sm:w-4/12"></div>
            <h1 class="sm:text-center w-8/12 text-3xl sm:text-5xl pl-6 sm:pl-0 text-gray-600 font-mono tracking-wide">
                Blog-a-lot
            </h1>
            @guest 
            <div class="w-4/12 text-gray-800 flex flex-col justify-center items-end">
                <div class="flex flex-col text-sm sm:text-lg items-center pr-6 sm:pr-12 tracking-widest">
                    <a href="{{ route('login') }}" class=" border-b border-gray-400 pb-1">
                        LOGIN
                    </a>
                    <a href="{{ route('register') }}" class="mt-1">
                        REGISTER
                    </a>
                </div>
            </div>
            @endguest
            @auth()
                
            <div class="w-4/12 text-gray-800 flex flex-col justify-center items-end">
                <div class="flex flex-col text-sm sm:text-lg items-center pr-6 sm:pr-12 tracking-widest">
                    <a href="{{ route('dashboard') }}" class=" border-b border-gray-400 pb-1">
                        {{ auth()->user()->name }}
                    </a>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="mt-1">
                            LOGOUT
                        </button>
                    </form>
                </div>
            </div>
            @endauth
        </div>
        <nav class="w-full border-t border-b border-gray-300">
            <ul class="flex py-4 justify-center bg-gray-200 font-serif">
                <li class="px-6 text-xl underline border-r-2 border-gray-300">
                    <a href="{{ route('home') }}">Home</a>
                </li>
                <li class="px-6 text-xl underline border-r-2 border-gray-300">
                    <a href="">Categories</a>
                </li>
                <li class="px-6 text-xl underline">
                    <a href="">About</a>
                </li>
            </ul>
        </nav>
    </header>
