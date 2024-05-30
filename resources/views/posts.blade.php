<x-layout content="">

@include ('_post-header')

    <main class="max-w-6xl mx-auto mt-6 lg:mt-20 space-y-6">
@if($posts->count())
       <x-posts-grid :posts="$posts" />
        @else
            <p class="text-center"><strong>No posts yet. Please check later</strong></p>
        @endif

    </main>

    <div class="text-center">
        <p>
            paginate
        </p>
            {{$posts->links()}}

{{--        @for($i = 1 ; $i <= $pageNumbers; $i++)--}}
{{--            <a href="../posts/?page={{$i}}"> <p class="inline-flex p-x-4">--}}
{{--                {{$i}}--}}
{{--            </p></a>--}}
{{--        @endfor--}}
    </div>
</x-layout>
