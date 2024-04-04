<x-layout>
    <section class="px-6 py-8">
        <main class="max-w-lg mx-auto mt-10 ">
            <x-panel class="bg-red-200 mb-3">
                <h1 class="text-center">Your account is unverified!</h1>
                <h2 class="text-center">Please verify it first</h2>
            </x-panel>
            <x-panel class="bg-blue-100 mb-3">
                <h1 class="text-center font-bold text-xl">Email Verification Link have been sent to your email</h1>
                <h2 class="text-center">Verify Your Email to continue..</h2>
            </x-panel>
            <form method="post" action="{{route('verification.send')}}">
                @csrf
                <button class="flex-1 bg-green-300 text-xs font-bold uppercase rounded-full py-3 px-12 flex lg:inline-flex hover:bg-green-500">Resend Verification Link</button>
            </form>
        </main>
    </section>
</x-layout>
