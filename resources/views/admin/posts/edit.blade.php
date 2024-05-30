<x-layout>

    <x-setting :heading="'Edit Post: ' . '<strong>' . $post->title . '</strong>'" >
        <form action="{{ route('admin.posts.update' , $post->id ) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <x-form.input name="title" :value="$post->title" />
            <x-form.input name="author" value="{{auth()->user()->name}}" />
            <x-form.input name="excerpt" :value="$post->excerpt" />
            <div class="flex">
                <x-form.input name="thumbnail" type="file" :value="$post->thumbnail ? $post->thumbnail : '' " />
                <img src="{{ $post->thumbnail ? asset('storage/' . $post->thumbnail) : ''}}" width="100">
            </div>

            <x-form.label name="body" />
            <x-form.textarea name="body" > {!! $post->body !!} </x-form.textarea>


            <x-form.label name="category" />
            <select name="category" id="category">
                <option selected>
                    {{$post->category->name}}
                </option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">
                        {{$category->name}}
                    </option>
                @endforeach

            </select>

            <x-form.button value="Update" />

            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li class="text-red-700 py-2" >
                            {{$error}}
                        </li>
                    @endforeach
                </ul>
            @endif
        </form>
    </x-setting>

</x-layout>

