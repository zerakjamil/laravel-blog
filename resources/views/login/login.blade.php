<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 bg-gray-100 p-6 rounded-xl border-gray-200">
            <div class="text-center mb-5">
                <h1 class="text-bold text-xl block">
                   Laravel Blog
                </h1>
                <h3>
                    Login
                </h3>
            </div>
            <form action={{route('user.login')}} method="post">
                @csrf
                <x-form.input name="username" type="text" />
                <x-form.input name="password" type="password" />
                <x-form.button value="Log in" />
                </div>
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

        </main>
    </section>
</x-layout>
