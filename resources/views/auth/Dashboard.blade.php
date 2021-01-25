@extends('_layouts.app')
@section('content')


<script defer>
    let sections = document.getElementsByName('section');
    let buttons = document.getElementsByClassName('section-btn')

     window.onload = function(){
        if(!document.referrer.includes('dashboard') && !document.referrer.includes('user')){
         console.log(document.referrer)

            sessionStorage.clear();
        }
        if(sessionStorage.getItem('currentView') !== null){
            show(sessionStorage.getItem('currentView'));
            for(let i=0; i<buttons.length ;i++) {
                buttons[i].classList.remove('bg-blue-100');
            };
            document.getElementsByName(sessionStorage.getItem('currentView'))[0].classList.add('bg-blue-100');
        }
    }

    function show(e){
        if(typeof e === 'object'){
            for(let i=0; i<buttons.length ;i++) {
                buttons[i].classList.remove('bg-blue-100');
            };
            e.classList.add('bg-blue-100');
        }
        let targetName = typeof e === 'string' ? e : e.name;
        let target = document.getElementById(targetName); 
        sessionStorage.setItem('currentView', targetName);
        sections.forEach(section => {
            section.classList.add('hidden');
            section.classList.remove('block');
        });
        target.classList.add('block')
        target.classList.remove('hidden')
    }
</script>

<div class="flex flex-col items-center flex-grow">
    <h1 class="text-2xl mt-4 tracking-wide">{{ $user->name }} Dashboard</h1>
    <small class="font-mono text-gray-500">Manage all your data on this page</small>
    <div class="flex flex-col items-center w-11/12 sm:w-10/12 lg:w-8/12 xl:w-7/12 p-2 mt-2">
        <ul class="flex justify-center">
            <li>
                <button type="button" onclick="show(this)" name="info" class="border p-3 text-lg bg-blue-100 focus:outline-none section-btn">
                    Info
                </button>
            </li>
            <li>
                <button type="button" onclick="show(this)" name="posts" class="border p-3 text-lg focus:outline-none section-btn">
                    Posts
                </button>
            </li>
            <li>
                <button type="button" onclick="show(this)" name="comments" class="border p-3 text-lg focus:outline-none section-btn">
                    Comments
                </button>
            </li>
            <li>
                <button type="button" onclick="show(this)" name="votes" class="border p-3 text-lg focus:outline-none section-btn">
                    Votes
                </button>
            </li>
            @if(auth()->id() === $user->id)
            <li>
                <button type="button" onclick="show(this)" name="settings" class="border p-3 text-lg focus:outline-none section-btn">
                    Settings
                </button>
            </li>
            @endif
        </ul>
        <div class=" shadow p-2" id="info" name="section">
            <x-dashboard.info :user="$user"/>
        </div>
        <div class="w-full shadow p-2 hidden" id="posts" name="section">
            @foreach ($posts as $post)
                <x-dashboard.posts :post="$post"/>
            @endforeach
            {{ $posts->links() }}  
        </div>
        <div class="w-full shadow p-2 hidden" id="comments" name="section">
            @foreach ($comments as $comment)
                <x-dashboard.comments :comment="$comment"/>
            @endforeach
            {{ $comments->links() }}  
        </div>
        <div class="w-full shadow p-2 hidden" id="votes" name="section">
            @foreach ($votes as $vote)
                <x-dashboard.votes :vote="$vote"/>
            @endforeach
            {{ $votes->links() }}  
        </div>
        @if(auth()->id() === $user->id)
            <div class="w-full shadow p-2 hidden" id="settings" name="section">
                SETTINGS
            </div>
        @endif
    </div>
</div>
@endsection