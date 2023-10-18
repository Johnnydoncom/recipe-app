<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\User;

new #[Layout('layouts.app')] class extends Component
{
    use WithPagination;

    public function with(): array
    {
        return [
            'users' => User::paginate(12),
        ];
    }
}; ?>

<div class="container py-14">
    <h2 class="font-bold text-2xl mb-6 text-black">All Users</h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        @forelse($users as $user)
        <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <div class="flex flex-col items-center p-10">
                <img class="w-24 h-24 mb-3 rounded-full shadow-lg" src="{{$user->avatar_url}}" alt="Bonnie image"/>
                <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$user->name}}</h5>
                <span class="text-sm text-gray-500 dark:text-gray-400">{{$user->email}}</span>
            </div>
        </div>
        @empty
        <div class="lg:col-span-3 bg-white rounded-4xl p-5">No record found.</div>
        @endforelse
    </div>
    <div class="py-4">{{ $users->links() }}</div>
</div>
