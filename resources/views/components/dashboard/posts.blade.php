@props(['post'])

<div class="text-lg text-gray-500 flex items-center justify-between border">
    <div class="border-r px-2 my-2 text-sm text-center text-gray-600">
        <form action="{{ route('post.vote', ['id' => $post->id]) }}" method="POST" id="{{ $post->id }}">
            @csrf
            <button type="submit" class="bg-green-200 p-2">
                {{ $post->votes_count }} votes
            </button>
        </form>
    </div>
    <div class="w-full px-2 my-2">
        <a href="{{ route('post', ['id' => $post->id]) }}" class="text-indigo-900">{{ $post->title }}</a>
        <div class="text-xs"> in
            @if(is_array($post->categories->pluck(['name'])->toArray()))
                @foreach ($post->categories->pluck(['name'])->toArray() as $cat)
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