@props(['vote'])

@php
    // dd($vote)
@endphp

<ul class="flex items-center justify-between">
    <li class="bg-gray-50 mb-1 shadow border rounded w-full">
        <div class="bg-blue-50 px-2 pt-2 text-xs pb-2  flex justify-between">
            <div>
                <a href="{{ route('post', ['id' =>$vote->post->id]) }}" class="text-blue-500">
                {{ $vote->created_at->diffForHumans()}} <p class="inline text-black"> voted for - </p> 
                {{ $vote->post->title}}</a>
            </div>
            <div>
                {{ $vote->created_at }}
            </div>
        </div>

    </li>
</ul>