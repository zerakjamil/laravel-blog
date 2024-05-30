@props(['name' , 'cols' => 30 , 'rows' => 10 , 'value' => old($name)])

<textarea
    class="border border-gray-200 p-2 w-full rounded-lg"
    name="{{$name}}"
    id="{{$name}}"
    cols="{{$cols}}"
    rows="{{$rows}}"
>
                {{$slot ?? $value}}
            </textarea>
