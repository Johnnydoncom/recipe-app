<?php

use Livewire\Volt\Component;

new class extends Component
{
    public function logout(): void
    {
        auth()->guard('web')->logout();

        session()->invalidate();
        session()->regenerateToken();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100" x-cloak>
    <!-- Primary Navigation Menu -->
    <div class="container px-4 sm:px-4">
        <div class="flex items-center justify-between h-16 transition ease-linear transition-all">
            <!-- Logo -->
            <div class="shrink-0 flex items-center ">
                <a href="{{ route('profile') }}" wire:navigate>
                    <x-application-logo class="block font-bold text-2xl lg:text-3xl text-primary" />
                </a>
            </div>
            <!-- Navigation Links -->
            <div class="hidden space-x-2 lg:space-x-4 sm:flex sm:items-center">
                <ul class="flex flex-col md:flex-row md:space-x-4 md:text-sm md:font-medium text-secondary">
                    <li>
                        <x-nav-link :href="route('index')" :active="request()->routeIs('index')" wire:navigate>
                            {{ __('Home') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('recipes.index')" :active="request()->routeIs('recipes.index')" wire:navigate>
                            {{ __('Recipes') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')" wire:navigate>
                            {{ __('Users') }}
                        </x-nav-link>
                    </li>
                    <li>
                        <x-nav-link :href="route('restaurants.index')" :active="request()->routeIs('restaurants.index')" wire:navigate>
                            {{ __('Restaurants') }}
                        </x-nav-link>
                    </li>

                    @guest
                        <li>
                            <x-nav-link :href="route('login')" :active="request()->routeIs('login')" wire:navigate>
                                {{ __('Login') }}
                            </x-nav-link>
                        </li>

                        @if(Route::has('register'))
                        <li>
                            <x-nav-link :href="route('register')" :active="request()->routeIs('register')" wire:navigate>
                                {{ __('Register') }}
                            </x-nav-link>
                        </li>
                        @endif
                    @endif
                </ul>

                @auth
                <div class="hidden sm:flex sm:items-center sm:ml-14">
                    <x-dropdown class="items-center">
                        <x-slot name="trigger">
                            <x-avatar sm src="{{Auth::user()->avatar_url}}" />
                        </x-slot>

                        <x-dropdown.item label="Profile" :href="route('profile')" wire:navigate />
                        <x-dropdown.item separator  wire:click="logout" label="Logout" />
                    </x-dropdown>
                </div>
                @endauth
            </div>

            <!-- Hamburger -->
            <div class="-mr-2 items-center items-center flex lg:hidden lg:justify-end">
                <button @click="open = ! open" class="sm:hidden inline-flex items-center justify-center p-2 rounded-md focus:outline-none focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div x-show="open" class="z-50 fixed h-auto top-20 right-4 w-56"
         x-transition:enter="transition ease-out duration-300 transform"
         x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave="transition ease-in duration-200 transform"
         x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">
        <div class="bg-black opacity-30 fixed inset-0 transition-opacity" @click="open = false"></div>

        <div class="bg-white shadow-xl w-full max-w-xs h-auto z-30 absolute p-4 rounded-xl transition-all transform">
            <div class="flex justify-end">
                <button type="button" class="btn btn-ghost btn-sm -m-2 p-2 rounded-md inline-flex items-center justify-center text-secondary focus:bg-gray-100" @click="open = false">
                    <span class="sr-only">Close menu</span>
                    <svg class="h-6 w-6" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M9.75 9.75l4.5 4.5m0-4.5l-4.5 4.5M21 12a9 9 0 11-18 0 9 9 0 0118 0z" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </button>
            </div>

            <div class="pt-4 pb-3 space-y-1 overflow-y-scroll max-h-screen" style="max-height: 70vh;">

                <ul class="flex flex-col justify-center items-center text-center gap-2">
                    <li>
                        <x-responsive-nav-link :href="route('index')" :active="request()->routeIs('index')" wire:navigate>
                            {{ __('Home') }}
                        </x-responsive-nav-link>
                    </li>
                    <li>
                        <x-responsive-nav-link :href="route('recipes.index')" :active="request()->routeIs('recipes.index')" wire:navigate>
                            {{ __('Recipes') }}
                        </x-responsive-nav-link>
                    </li>
                    <li>
                        <x-responsive-nav-link :href="route('restaurants.index')" :active="request()->routeIs('restaurants.index')" wire:navigate>
                            {{ __('Restaurants') }}
                        </x-responsive-nav-link>
                    </li>
                    <li>
                        <x-responsive-nav-link :href="route('users.index')" :active="request()->routeIs('users.index')" wire:navigate>
                            {{ __('Users') }}
                        </x-responsive-nav-link>
                    </li>

                    @auth
                    <li>
                        <x-responsive-nav-link :href="route('profile')" :active="request()->routeIs('profile')" wire:navigate>
                            {{ __('Profile') }}
                        </x-responsive-nav-link>
                    </li>

                    <li>
                        <button wire:click="logout" class="w-full text-left">
                            <x-responsive-nav-link>
                                {{ __('Log Out') }}
                            </x-responsive-nav-link>
                        </button>
                    </li>
                    @else
                        @if(Route::has('register'))
                        <li>
                            <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')" wire:navigate>
                                {{ __('Register') }}
                            </x-responsive-nav-link>
                        </li>
                        @endif
                        <li>
                            <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')" wire:navigate>
                                {{ __('Login') }}
                            </x-responsive-nav-link>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</nav>
