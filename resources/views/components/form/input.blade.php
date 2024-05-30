@props(['name' , 'type' => 'text' , 'value' => old($name)])
<x-form.label :name="$name" />

<input
    class="border border-gray-200 p-2 w-full rounded-lg"
    type="{{$type}}"
    name="{{$name}}"
    id="{{$name}}"
    value="{{$value}}"
>
