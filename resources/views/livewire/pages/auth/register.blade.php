<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.app')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $phone = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'phone' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        auth()->login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<x-auth-card>
    <div class="text-center space-y-2 mb-5">
        <h2 class="font-semibold text-2xl 2xl:text-3xl text-center">Create Account</h2>
        <p class="text-gray-600 text-sm sm:text-lg">Create your account for free.</p>

    </div>
    <form wire:submit="register">
        <!-- Name -->
        <div>
            <x-input :label="__('Name')" wire:model="name" id="name" class="block mt-1 w-full" type="text" name="name" required autofocus autocomplete="name" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input :label="__('Email Address')" wire:model="email" id="email" type="email" name="email" required autocomplete="username" />
        </div>

        <!-- Phone Number -->
        <div class="mt-4">
            <x-inputs.phone :label="__('Phone Number')" wire:model="phone" id="phone" required />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-inputs.password :label="__('Password')" wire:model="password" id="password" type="password" name="password" required autocomplete="new-password" />
        </div>


        <div class="mt-4">
            <x-button class="w-full" type="submit" spinner="register" primary>
                {{ __('Register') }}
            </x-button>

            <p class="text-center py-5">
                Already have an account?
                <a class="underline text-primary" href="{{ route('login') }}" wire:navigate>
                    {{ __('Sign In') }}
                </a>
            </p>

        </div>
    </form>
</x-auth-card>
