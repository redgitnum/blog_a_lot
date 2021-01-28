@props(['post'])

@php
    // dd(empty($post->votes->where('post_id', 76)->all()));
@endphp

<script defer>
    function toggleConfirm(e, parent){
        parent.innerText = parent.innerText === 'Delete' ? 'Cancel?' : 'Delete';
        parent.classList.toggle('bg-red-500');
        parent.classList.toggle('hover:bg-red-600');
        parent.classList.toggle('active:bg-red-500');
        parent.classList.toggle('bg-blue-500');
        parent.classList.toggle('hover:bg-blue-600');
        parent.classList.toggle('active:bg-blue-500');
        e.classList.toggle('invisible');
    }
</script>

<div class="w-full bg-white shadow rounded-md rounded-b-none border-gray-400 overflow-hidden">
    <div class="text-lg text-gray-500 flex items-center justify-between @can('update', $post) bg-green-100 @endcan">
        <div class="border-r px-2 my-2 text-sm text-center text-gray-600">
            <form action="{{ route('post.vote', ['id' => $post->id]) }}" method="POST" id="{{ $post->id }}">
                @csrf
                <button type="submit" 
                class="p-2 flex text-lg text-white 
                @if($post->votes->where('user_id', auth()->id())->isEmpty())bg-blue-400 hover:bg-green-300 hover:text-black transition 
                @else bg-green-400 hover:bg-red-300 hover:text-black 
                @endif rounded">
                    @if($post->votes->where('user_id', auth()->id())->isEmpty())
                        <div>&#8593;</div>
                    @else 
                        <div>&#8595;</div>
                    @endif
                        <div class="hidden @if($post->votes->where('user_id', auth()->id())->isEmpty())block @endif">&#8593;</div>
                    <div class="px-2">
                        {{ $post->votes_count }}
                    </div>
                </button>
            </form>
        </div>
        <div class="w-full px-2 pl-4 my-2">
            <p>
                <a href="{{ route('post', ['id' => $post->id]) }}" class="text-indigo-900">{{ $post->title }}</a>, by 
                <a href="{{ route('user', ['id' => $post->user->id]) }}" class="text-green-700">{{ $post->user->name }}</a>
            </p>
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
        @can('update', $post)            
            <form action="{{ route('post.edit', ['id' => $post->id]) }}" class="flex my-1 items-center mr-1">
                @csrf
                <button type="submit"
                class="bg-green-500 hover:bg-green-600 active:bg-green-500 rounded p-2 mr-1 text-white">
                Edit
            </button>
            </form>
            <form action="{{ route('post.delete', ['id' => $post->id]) }}" method="POST" class="flex my-1 items-center mr-1">
                @csrf
                @method('DELETE')
                <button type="button" onclick="toggleConfirm({{ 'post'.$post->id }}, this)" 
                    class="bg-red-500 hover:bg-red-600 active:bg-red-500 rounded p-2 mr-1 text-white">
                    Delete
                </button>
                <button id="{{ 'post'.$post->id }}" type="submit" 
                    class="invisible p-2 bg-red-200 hover:bg-red-700 hover:text-white active:bg-red-500 rounded" 
                    title="confirm">
                    &#10003;
                </button>
            </form>
        @endcan
        <div class="w-24 px-2 my-2 uppercase text-gray-700 border-l text-center text-xs">{{ $post->created_at->diffForHumans() }}</div>
    </div>
    <div class="py-4 mx-6 @if(isset($post->comments_count)) max-h-60 @endif overflow-hidden border-t">
        {!! nl2br(e($post->body)) !!}
    </div>
</div>