<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Restaurant;
use Stevebauman\Location\Facades\Location;

new #[Layout('layouts.app')] class extends Component
{
    use WithPagination;

    public function with(): array
    {
        $ip = request()->ip();
        if ($location = Location::get($ip)) {
            // fetch data from api

        }

        return [
            'restaurants' => Restaurant::paginate(12),
        ];
    }
}; ?>

<div class="container py-14">
    <h2 class="font-bold text-2xl mb-6 text-black">Restaurants near me</h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
        @forelse($restaurants as $restaurant)
            <div class="w-full max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                <div class="flex flex-col items-center p-10">
                    <h5 class="mb-1 text-xl font-medium text-gray-900 dark:text-white">{{$restaurant->name}}</h5>
                </div>
            </div>
        @empty
            <div class="lg:col-span-3 bg-white rounded-4xl p-5">No record found.</div>
        @endforelse
    </div>
    <div class="py-4">{{ $restaurants->links() }}</div>
</div>

