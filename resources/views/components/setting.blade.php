@props(['categories' , 'heading'])
<section class="px-6 py-8">
    <div class="max-w-4xl mx-auto mt-10 bg-gray-100 p-6 rounded-xl border-gray-200">
        <h1 class="text-center">
            {!!ucwords($heading)!!}
        </h1>
        <h4 class="font-semibold mb-4">
            Links
        </h4>
        <div class="flex">

        <aside class="w-48">
            <ul>
                <li class="mb-2">
                    <a
                        href="{{ route('admin.index.post') }}"
                        class="{{request()->is('admin/posts') ? 'text-blue-500':''}}"

                    >
                        All Posts
                    </a>
                </li>

                <li class="mb-2">
                    <a
                        href="admin/dashboard"
                        class="{{request()->is('admin/dashboard') ? 'text-blue-500':''}}"

                    >
                        Dashboard
                    </a>
                </li>

                <li class="mb-2">
                    <a
                        href="{{ route('admin.create.post') }}"
                       class="{{request()->is('admin/posts/create') ? 'text-blue-500':''}}"

                    >
                        New Post
                    </a>
                </li>
            </ul>
        </aside>
<main class="flex-1">
    {{$slot}}
</main>
    </div>

    </div>
</section>
