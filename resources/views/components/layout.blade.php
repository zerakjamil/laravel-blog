<!doctype html>

<title>Laravel Blog</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<meta name="csrf-token" content="{{ csrf_token() }}">
<link href="{{ mix('css/app.css') }}" rel="stylesheet">
<style>
    html{
        scroll-behavior: smooth;
    }
</style>
<body style="font-family: Open Sans, sans-serif">
<section class="px-6 py-8">
    <nav class="md:flex md:justify-between md:items-center">
        <div>
            <a href={{route('home')}}>

            </a>
        </div>

        <div class="mt-8 md:mt-0 flex items-center">
            @if(auth()->check())

                <x-dropdown>

                    <x-slot:trigger>
                        <button
                        class="text-xs font-bold uppercase px-4"
                    >
                        Welcome, {{Auth::user()->is_admin ? Auth::user()->name.' (admin)' : Auth::user()->name.'!' }}
                    </button>
                    </x-slot:trigger>

                        @auth
                            @if(Auth::user()->is_admin == true)
                                <x-dropdown-item href="{{ route('admin.posts.create') }}"
                                                 :active="request()->is(route('admin.posts.create'))"
                                >
                                    New Post
                                </x-dropdown-item>

                                <x-dropdown-item href="/admin/dashboard">
                                    Dashboard
                                </x-dropdown-item>
                            @endif
                        @endauth

                    <x-dropdown-item href="{{route('home')}}">
                        Home
                    </x-dropdown-item>

                    <x-dropdown-item
                        href="#"
                        x-data="{}"
                        @click.prevent="document.querySelector('#logout-form').submit()"
                    >
                        Log Out
                    </x-dropdown-item>


                    <form
                        id="logout-form"
                        action="{{route('user.logout')}}"
                        method="post"
                        class="hidden"
                    >
                        @csrf
                    </form>
                </x-dropdown>



            @else
            <a href={{route('user.register')}} class="text-xs font-bold uppercase px-4">Register</a>
            <a href="{{route('user.login')}}" class="text-xs font-bold uppercase px-4">Log In</a>
            @endif
            <a href="#newsletter" class="bg-blue-500 ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-5">
                Subscribe for Updates
            </a>
        </div>
    </nav>

    {{$slot}}

    <footer id="newsletter" class="bg-gray-100 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
        <img src="/images/lary-newsletter-icon.svg" alt="" class="mx-auto -mb-6" style="width: 145px;">
        <h5 class="text-3xl">Stay in touch with the latest posts</h5>
        <p class="text-sm mt-3">Promise to keep the inbox clean. No bugs.</p>

        <div class="mt-10">
            <div class="relative inline-block mx-auto lg:bg-gray-200 rounded-full">

                <form method="POST" action="#" class="lg:flex text-sm">
                    <div class="lg:py-3 lg:px-5 flex items-center">
                        <label for="email" class="hidden lg:inline-block">
                            <img src="/images/mailbox-icon.svg" alt="mailbox letter">
                        </label>

                        <input id="email" type="text" placeholder="Your email address"
                               class="lg:bg-transparent py-2 lg:py-0 pl-4 focus-within:outline-none">
                    </div>

                    <button type="submit"
                            class="transition-colors duration-300 bg-blue-500 hover:bg-blue-600 mt-4 lg:mt-0 lg:ml-3 rounded-full text-xs font-semibold text-white uppercase py-3 px-8"
                    >
                        Subscribe
                    </button>
                </form>

            </div>

        </div>
    </footer>
</section>

<x-flash />
</body>
<script src=""></script>
