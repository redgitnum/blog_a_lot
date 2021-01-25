@props(['post'])


<div class="w-full bg-white shadow rounded-md rounded-b-none border-gray-400">
    <div class="text-lg text-gray-500 flex items-center justify-between">
        <div class="border-r px-2 my-2 text-sm text-center text-gray-600">
            <form action="{{ route('post.vote', ['id' => $post->id]) }}" method="POST" id="{{ $post->id }}">
                @csrf
                <button type="submit" class="bg-green-200 p-2">
                    {{ $post->votes_count }} votes
                </button>
            </form>
        </div>
        <div class="w-full px-2 my-2">
            <p><a href="{{ route('post', ['id' => $post->id]) }}" class="text-indigo-900">{{ $post->title }}</a>, by <a href="{{ route('user', ['id' => $post->user->id]) }}" class="text-green-700">{{ $post->user->name }}</a></p>
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
    <div class="py-4 mx-6 @if(isset($post->comments_count)) max-h-60 @endif overflow-hidden border-t">
        {!! nl2br(e($post->body)) !!}
    </div>
</div>