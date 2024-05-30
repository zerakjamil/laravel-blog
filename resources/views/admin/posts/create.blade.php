<x-layout>

    <x-setting heading="Publish a new post" :categories="$categories">
        <form action="/admin/post" method="post" enctype="multipart/form-data">
            @csrf

            <x-form.input name="title" />
            <x-form.input name="author" value="{{auth()->user()->name}}" />
            <x-form.input name="excerpt" />
            <x-form.input name="thumbnail" type="file" />
            <x-form.label name="body" />
            <x-form.textarea name="body" />


            <x-form.label name="category" />
            <select name="category" id="category">
                <option selected>
                    --select a category --
                </option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">
                        {{$category->name}}
                    </option>
                @endforeach

            </select>

            <x-form.button value="Publish" />

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
