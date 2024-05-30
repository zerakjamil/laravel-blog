@props(['comment'])
<article class="flex bg-gray-100 p-2 rounded-full border border-gray-200">
    <div class="pr-2" style="
    display: flex;
    align-items: center;
    justify-content: center;
    justify-items: center;
    width: 25%;">
        <img src="https://i.pravatar.cc/100?u={{$comment->user_id}}" class="rounded-full border-black-100 " width="60">
    </div>

    <div>
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
</article>
