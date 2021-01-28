@props(['comment'])


<script defer>
    function showEditComment(e, parent){
        e.classList.toggle('hidden')
        parent.innerText === 'Edit' ? parent.innerText = 'Cancel' : parent.innerText = 'Edit';
        parent.classList.toggle('bg-green-500')
        parent.classList.toggle('hover:bg-green-600')
        parent.classList.toggle('active:bg-green-500')
        parent.classList.toggle('bg-blue-500')
        parent.classList.toggle('hover:bg-blue-600')
        parent.classList.toggle('active:bg-blue-500')
    }

</script>

<ul class="flex items-center justify-between">
    <li class="bg-gray-50 pb-2 mb-2 shadow-lg border rounded w-full" id="{{ 'comment-'.$comment->id }}">
        <div class="bg-blue-50 px-2 pt-2 text-xs pb-2 border-b border-gray-500 flex justify-between items-center">
            <div>
                <a href="{{ route('post', ['id' =>$comment->post->id]).'#comment-'.$comment->id }}" class="text-blue-500">{{ $comment->created_at->diffForHumans()}}</a> in - 
                <a href="{{ route('post', ['id' =>$comment->post->id]) }}" class="text-blue-500">{{ $comment->post->title}}</a> - You said:
            </div>
            <div class="flex items-center">
                @can('update', $comment)
                    <button type="button"
                    onclick="showEditComment({{ 'comment'.$comment->id }}, this)"
                    class="bg-green-500 hover:bg-green-600 active:bg-green-500 rounded p-1 mr-1 text-white">
                    Edit
                    </button>
                    <form action="{{ route('comment.delete', ['id' => $comment->id]) }}" method="POST" class="flex my-1 items-center mr-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                        class="bg-red-500 hover:bg-red-600 active:bg-red-500 rounded p-1 mr-1 text-white">
                        Delete
                        </button>
                    </form>
                @endcan
                <div>
                    {{ $comment->created_at }}
                </div>
            </div>
        </div>
        <div class="px-4 py-3 text-gray-700">
            {!! nl2br(e($comment->body)) !!}
        <div>
        @can('update', $comment)
            <div class="hidden mt-2 border-t border-gray-400 pt-1" id="{{ 'comment'.$comment->id }}">
                @error('body')
                <div class="text-red-500 my-1 text-sm">{{ $message }}</div>
                @enderror
                <form action="{{ route('comment.edit', ['id' => $comment->id]) }}" method="POST">
                    @csrf
                    <textarea name="body" rows="3" class="resize-none w-full bg-gray-100 shadow p-2 rounded-t" 
                    placeholder="Write something...">{{ $comment->body }}</textarea>
                    <button class="p-2 w-full transition-all bg-green-400 hover:bg-green-500
                    active:bg-green-400 shadow text-white uppercase font-bold rounded-b" 
                    type="submit">
                    Edit Comment
                    </button>
                </form>
            </div>
        @endcan
    </li>
</ul>