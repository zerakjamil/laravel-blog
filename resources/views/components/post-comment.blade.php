@props(['comment','likes'])

<div id="app">
    @yield('content')
</div>
<article class="flex bg-gray-100 p-2 rounded-full border border-gray-200 items-center">
    <div class="pr-2" style="display: flex; align-items: center; justify-content: center; width: 25%;">
        <img src="https://i.pravatar.cc/100?u={{$comment->user_id}}" class="rounded-full border-black-100" width="60">
    </div>

    <div class="flex-grow">
        <header>
            <h3 class="font-bold">
                {{$comment->user->name}}
            </h3>
            <p class="text-xs">
                Posted
                <time>{{$comment->created_at->diffForHumans()}}</time>
            </p>
            <p class="mt-2">
                {{$comment->body}}
            </p>
        </header>
    </div>

    <div class="ml-2 flex items-center">
        @if(Auth::user())
            <form method="POST" action="{{route('posts.comments.like',$comment->id)}}" class="flex items-center">
                @csrf
                <button type="submit" class="like-btn bg-blue-500 text-white font-bold py-1 px-3 rounded-full text-xs mr-2"
                        data-comment-id="{{ $comment->id }}"
                >Like</button>
            </form>
        @endif

        <span class="text-sm text-gray-700">
            {{count($likes)}} {{ Str::plural('like', $comment->like) }}
        </span>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</article>
