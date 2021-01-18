@props(['post'])
@php

// if(is_array($post->categories) && !empty($post->categories))
// {
//     foreach($post->categories as $emp)
//     {
//         var_dump($emp);
//     }
// }
    //  dd($post->categories);
@endphp

<div class="w-full bg-white shadow rounded-md border-gray-400 mb-4">
    <div class="text-lg text-gray-500 flex items-center justify-between">
        <div class="border-r px-2 my-2 text-sm text-center text-gray-600">
            15 votes
        </div>
        <div class="w-full px-2 my-2">
            <div class="text-indigo-900">{{ $post->title }}, by {{ $post->user->name }}</div>
            <div class="text-xs"> in
                @if(is_array($post->categories))
                    @foreach ($post->categories as $cat)
                        <span class="text-blue-500 uppercase">
                            @if ($loop->last)
                                {{ $cat }}
                            @else
                                {{ $cat }} - 
                            @endif
                        </span>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="w-24 px-2 my-2 uppercase text-gray-700 border-l text-center text-xs">{{ $post->created_at->diffForHumans() }}</div>
    </div>
    <div class="py-4 mx-6 max-h-60 overflow-hidden border-t">
        
        {{  $post->body }}
    </div>
    <div class="border-t mx-6 py-4 flex justify-between items-center">
        <div class="text-gray-500 font-mono">
            {{ $post->comments->count() }} Comments 
        </div>
        <div class="text-sm uppercase font-mono text-gray-600 ">
            continue reading>>
        </div>
    </div>
</div>