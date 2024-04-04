<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 ">
            <x-panel class="bg-blue-100">
                <h1 class="text-center font-bold text-xl">Password Reset</h1>

                <form method="post" action="{{route('password.email')}}" class="mt-10">
                    @csrf
                    <h1 class="text-center">Please enter you email</h1>
                    <x-form.input name="email" type="email"></x-form.input>

                    <x-form.button>Submit</x-form.button>
                </form>
            </x-panel>
        </main>
    </section>
</x-layout>
