@props(['recipe'])
<div class="flex items-center gap-2 lg:gap-4">
    <img src="{{Storage::url($recipe->image)}}" class="w-32 h-32 object-cover rounded-2xl" alt="{{$recipe->name}}">
    <div class="flex flex-col gap-2 justify-between w-full">
        <div>
            <h2 class="font-semibold text-lg line-clamp-2">{{$recipe->name}}</h2>
            <p class="text-xs text-primary">{{$recipe->source}}</p>
            <p class="text-xs">{{count($recipe->ingredients)}} {{ \Illuminate\Support\Str::plural('Ingredient', count($recipe->ingredients)) }} </p>
        </div>
        <x-button :href="route('recipes.show', $recipe->slug)" primary wire:navigate>View Recipe</x-button>
    </div>
</div>
