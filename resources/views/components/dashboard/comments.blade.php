@props(['comment'])


<ul class="flex items-center justify-between">
    <li class="bg-gray-50 pb-2 mb-2 shadow-lg border rounded w-full" id="{{ 'comment-'.$comment->id }}">
        <div class="bg-blue-50 px-2 pt-2 text-xs pb-2 border-b border-gray-500 flex justify-between">
            <div>
                <a href="{{ route('post', ['id' =>$comment->post->id]).'#comment-'.$comment->id }}" class="text-blue-500">{{ $comment->created_at->diffForHumans()}}</a> in - 
                <a href="{{ route('post', ['id' =>$comment->post->id]) }}" class="text-blue-500">{{ $comment->post->title}}</a> - You said:
            </div>
            <div>
                {{ $comment->created_at }}
            </div>
        </div>
        <div class="px-4 py-3 text-gray-700">
            {!! nl2br(e($comment->body)) !!}
        <div>
    </li>
</ul>