@props(['post'])

<div class="w-full bg-white shadow rounded-md rounded-b-none border-gray-400">
    <div class="text-lg text-gray-500 flex items-center justify-between">
        <div class="border-r px-2 my-2 text-sm text-center text-gray-600">
            15 votes
        </div>
        <div class="w-full px-2 my-2">
            <div class="text-indigo-900">{{ $post->title }}, by {{ $post->user->name }}</div>
            <div class="text-xs"> in
                @if(is_array($post->categories))
                    @foreach ($post->categories as $cat)
                        <a href="{{ route('home.category', $cat) }}" class="text-blue-500 uppercase">
                            @if ($loop->last)
                                {{ $cat }}
                            @else
                                {{ $cat }} - 
                            @endif
                        </a>
                    @endforeach
                @endif
            </div>
        </div>
        <div class="w-24 px-2 my-2 uppercase text-gray-700 border-l text-center text-xs">{{ $post->created_at->diffForHumans() }}</div>
    </div>
    <div class="py-4 mx-6 max-h-60 overflow-hidden border-t">
        {!! nl2br(e($post->body)) !!}
    </div>
</div>