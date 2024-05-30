@props(['post'])
<form method="POST" action="../posts/{{$post->slug}}/addcomment" class="bg-grey-100 border border-grey-200 p-6 rounded-xl">
    @csrf
    <header>
        <h2 class="text-center text-bold">Want to participate?</h2>
    </header>
    <div class="flex" style="align-items: center;
    justify-content: center;
    justify-items: center;">
        <img src="https://i.pravatar.cc/60?u={{auth()->id()}}" class="rounded-full border-black-100 p-2" style="
    display: flex;
    align-items: center;
    justify-content: center;
    justify-items: center;
    width: 20%;">
       <x-form.textarea name="body" cols="10" rows="1" />
       <x-form.button value="Comment" />
    </div>
</form>
