<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 ">
            <x-panel class="bg-blue-100">
                <h1 class="text-center font-bold text-xl">Register!</h1>

                <form method="post" action="{{route('password.update')}}" class="mt-10">
                    @csrf

                    <x-form.input name="email" type="email"></x-form.input>
                    <x-form.input name="password" type="password"></x-form.input>
                    <x-form.input name="password_confirmation" type="password"></x-form.input>
                    <input name="token" type="hidden" value="{{$token}}">

                    <x-form.button>Submit</x-form.button>
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
