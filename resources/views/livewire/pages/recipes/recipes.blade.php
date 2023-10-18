<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Recipe;

new #[Layout('layouts.app')] class extends Component
{
    use WithPagination;

    public function with(): array
    {
        return [
            'recipes' => Recipe::paginate(12),
        ];
    }
}; ?>

<div>
    <div class="container bg-white rounded-4xl py-5 my-5">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            @forelse($recipes as $recipe)
                <x-recipe.design-1 :recipe="$recipe"/>
            @empty
                <div class="lg:col-span-3">No record found.</div>
            @endforelse
        </div>
        <div class="py-4">
            {{ $recipes->links() }}
        </div>
    </div>
</div>
