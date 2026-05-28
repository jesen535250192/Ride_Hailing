<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" :value="'Name'" />
            <x-text-input id="name" class="block mt-1 w-full"
                type="text" name="name" required autofocus />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="'Email'" />
            <x-text-input id="email" class="block mt-1 w-full"
                type="email" name="email" required />
        </div>

        <div class="mt-4">
            <x-input-label for="role" :value="'Role'" />
            <select id="role" name="role" required
                class="block mt-1 w-full border-gray-300 rounded-md shadow-sm">
                <option value="customer">Customer</option>
                <option value="driver">Driver</option>
            </select>
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="'Password'" />
            <x-text-input id="password" class="block mt-1 w-full"
                type="password" name="password" required />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="'Confirm Password'" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full"
                type="password" name="password_confirmation" required />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900"
                href="{{ route('login') }}">
                Already registered?
            </a>

            <x-primary-button class="ms-4">
                Register
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>