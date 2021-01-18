@extends('_layouts.app')
@section('content')
    <div class="flex flex-col items-center flex-grow">
            <h1 class="text-2xl mt-4 tracking-wide">Welcome to Blog-a-lot</h1>
            <small class="font-mono text-gray-500">A minimalistic multi-blog-thing</small>
            <div class="flex flex-col items-center w-11/12 sm:w-10/12 lg:w-8/12 xl:w-7/12">

                <p class="text-lg mx-10 pb-3 pt-6">Here you can make your dreams come true(facts!) and make your own blog without touching any of html,css code or any knowledge of how it works 
                    (well basically a cms).</p>
                <p class="text-lg mx-10 py-3" >The only thing that is required to do that is make an account with whatever info you want 
                    (email is not used for anything other that login, so you can make it up :)</p>
                <p class="text-lg mx-10 py-3 pb-10">You can use the site without registration but you will be limited only to viewing the content 
                    other users have created, so no adding posts, commenting or voting for your favourite creator.</p>
                <p class="text-xl mx-10 pb-6">But most importantly, have fun :)</p>
            </div>
    </div>
@endsection