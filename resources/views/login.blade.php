<x-layout>
    <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <h2 class="mt-10 text-center text-2xl font-bold tracking-tight text-gray-900">
            {{ request()->is('login') ? 'Log in' : 'Sign up' }}
        </h2>
    </div>

    <div class="mt-10 sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="{{ request()->is('login') ? '/login' : '/register' }}" method="POST">
            @csrf

            @if (!request()->is('login'))
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-900">Name</label>
                    <div class="mt-2">
                        <input type="text" name="name" id="name" autocomplete="name" required
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                               ring-1 ring-gray-300 placeholder:text-gray-400
                               focus:outline-none focus:ring-2 focus:ring-indigo-500
                               sm:text-sm">
                    </div>
                    @error('name')
                    <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            <div>
                <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                <div class="mt-2">
                    <input type="email" name="email" id="email" autocomplete="email" required
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                           ring-1 ring-gray-300 placeholder:text-gray-400
                           focus:outline-none focus:ring-2 focus:ring-indigo-500
                           sm:text-sm">
                    @error('email')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>

            </div>

            <div>
                <label for="password" class="block text-sm font-medium text-gray-900">Password</label>
                <div class="mt-2">
                    <input type="password" name="password" id="password" autocomplete="new-password" required
                           class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                           ring-1 ring-gray-300 placeholder:text-gray-400
                           focus:outline-none focus:ring-2 focus:ring-indigo-500
                           sm:text-sm">
                </div>
                @error('password')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            @if (!request()->is('login'))
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-900">Confirm Password</label>
                    <div class="mt-2">
                        <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="new-password" required
                               class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900
                               ring-1 ring-gray-300 placeholder:text-gray-400
                               focus:outline-none focus:ring-2 focus:ring-indigo-500
                               sm:text-sm">
                    </div>
                    @error('password_confirmation')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            @endif

            <div>
                <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                    {{ request()->is('login') ? 'Log in' : 'Register' }}
                </button>
            </div>
        </form>

        <p class="mt-8 text-center text-sm text-gray-500">
            {{ request()->is('login') ? 'No account yet?' : 'Already have an account?' }}
            <a href="{{ request()->is('login') ? '/register' : '/login' }}" class="font-semibold text-indigo-600 hover:text-indigo-500">
                {{ request()->is('login') ? 'Sign up to get started!' : 'Log in here' }}
            </a>
        </p>
    </div>
</x-layout>
