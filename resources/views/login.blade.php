<x-layout title="login">

    <x-slot:heading>
        Login page
    </x-slot:heading>


    <div class="max-w-xl mx-auto px-6 py-12 lg:px-8 mt-10">

        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
            <form method="POST" action="/login">
                @csrf
                <div>
                    <label for="email" class="block text-sm/6 font-medium text-gray-100">Email address</label>
                    <div class="mt-2">
                        <input id="email" type="email" name="email" autocomplete="email"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6 @error('email') border border-red-600 @enderror"
                            placeholder="John@example.com" value="{{ old('email') }}" />
                    </div>
                    <x-error name="email"></x-error>
                </div>

                <div class="mt-4">
                    <div class="flex items-center justify-between">
                        <label for="password" class="block text-sm/6 font-medium text-gray-100">Password</label>
                    </div>
                    <div class="mt-2">
                        <input id="password" type="password" name="password" autocomplete="current-password"
                            class="block w-full rounded-md bg-white/5 px-3 py-1.5 text-base text-white outline-1 -outline-offset-1 outline-white/10 placeholder:text-gray-500 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-500 sm:text-sm/6 @error('password') border border-red-600 @enderror"
                            placeholder="********" />
                    </div>
                    <x-error name="password"></x-error>
                </div>

                <div class="mt-4">
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:bg-indigo-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Login</button>
                </div>
            </form>


        </div>

    </div>

</x-layout>
