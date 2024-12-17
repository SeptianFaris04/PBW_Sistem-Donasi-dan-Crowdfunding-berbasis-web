<x-app-layout>

    @slot('title', 'Email-Verification')
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Email Verification') }}
        </h2>
    </x-slot>

    <x-maincontainer class="p-10">
        <div class="max-w-2xl">
            <div class="mb-4 text-sm text-gray-600">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </div>
        
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </div>
            @endif
        
            <div class="mt-4 flex items-center gap-2 justify-between">
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
        
                    <div>
                        <x-primary-button>
                            {{ __('Resend Verification Email') }}
                        </x-primary-button>
                    </div>
                </form>
                
                <a href="{{ Route('profile.edit') }}" class=" text-white bg-primary-950 hover:underline border rounded-lg p-1">
                    Edit Profile
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
        
                    <button type="submit" class="text-white bg-primary-950 border rounded-lg p-1 hover:underline focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        {{ __('Log Out') }}
                    </button>
                </form>

            </div>
        </div>
    </x-maincontainer>
</x-app-layout>
