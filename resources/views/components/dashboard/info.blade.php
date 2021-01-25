@props(['user'])


@php
    // dd($user)
@endphp
<div class="flex justify-center">
    <ul class="flex flex-col p-4 items-end">
        <li class="flex items-center pb-2">
            <div class="text-lg pr-2">Name: </div>
            <p class="bg-white rounded p-2">{{ $user->name }}</p>
        </li>
        <li class="flex items-center pb-2">
            <div class="text-lg pr-2">User since: </div>
            <p class="bg-white rounded p-2">{{ $user->created_at->diffForHumans() }}</p>
        </li>
    </ul>
    <ul class="flex flex-col p-4 items-end">
        <li class="flex items-center pb-2">
            <div class="text-lg pr-2">Posts: </div>
            <p class="bg-white rounded p-2">{{ $user->posts_count }}</p>
        </li>
        <li class="flex items-center pb-2">
            <div class="text-lg pr-2">Comments: </div>
            <p class="bg-white rounded p-2">{{ $user->comments_count }}</p>
        </li>
        <li class="flex items-center pb-2">
            <div class="text-lg pr-2">Votes: </div>
            <p class="bg-white rounded p-2">{{ $user->votes_count }}</p>
        </li>
    </ul>
    {{-- <li class="bg-gray-50 mb-1 shadow border rounded w-full">
        <div class="bg-blue-50 px-2 pt-2 text-xs pb-2  flex justify-between">
            <div>
                <a href="{{ route('post', ['id' =>$vote->post->id]) }}" class="text-blue-500">
                {{ $vote->created_at->diffForHumans()}} <p class="inline text-black"> You voted for - </p> 
                {{ $vote->post->title}}</a>
            </div>
            <div>
                {{ $vote->created_at }}
            </div>
        </div>

    </li> --}}
</div>