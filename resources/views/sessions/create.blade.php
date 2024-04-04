<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 ">
            <x-panel class="bg-blue-100">
                <h1 class="text-center font-bold text-xl">Log In!</h1>

                <form method="post" action="/login" class="mt-10">
                    @csrf

                    <x-form.input name="email" type="email" autocomplete="username"/>
                    <x-form.input name="password" type="password" autocomplete="new-password"/>


                    <x-form.button>Log In</x-form.button>
                    <a class="bg-red-500 text-white uppercase font-semibold text-xs py-2 px-10 rounded-2xl hover:bg-red-600"
                       href="{{route('password.request')}}"
                    >Forgot password</a>
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
