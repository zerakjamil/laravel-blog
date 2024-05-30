@if(session()->has('success'))
    <div
        x-data = "{ show:true }"
        x-init="setTimeout(()=> show = false , 5000)"
        x-show = "show"
        class="text-white bg-blue-500 fixed bottom-1 right-0 p-1 rounded-l-lg">
        <p>
            {{session()->get('success')}}
        </p>
    </div>
@endif
