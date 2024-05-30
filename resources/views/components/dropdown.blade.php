
@props(['trigger'])

<div x-data="{ show: false }" @click.away="show = false" class="relative">
<div @click=" show = !show">
    {{$trigger}}
</div>
    <div x-show="show" class="py-2 absolute bg-gray-100 mt-2 rounded-xl w-full z-50 max-h-52 overflow-auto" style="display:none;">

        {{$slot}}
    </div>
</div>
