<?php

use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Facades\Storage;

new #[Layout('layouts.app')] class extends Component
{
    public string $q = '';
    public array $diet = [];
    public array $health = [];
    public array $cuisineType = [];
    public array $mealType = [];

    public $recipes =[];

    public function mount(){

    }

    public function getDietsProperty(){
        return \App\Services\RecipeService::diets();
    }

    public function getHealthOptionsProperty(){
        return \App\Services\RecipeService::healthOptions();
    }

    public function getCuisineTypesProperty(){
        return \App\Services\RecipeService::cuisines();
    }

    public function getMealTypesProperty(){
        return \App\Services\RecipeService::meals();
    }

    public function search(): void
    {
//        $validated = $this->validate([
//            'name' => ['required', 'string', 'max:255'],
//            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
//            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
//        ]);

        $recipeService = new \App\Services\RecipeService();
        $response = $recipeService->recipes($this->only(['q', 'diet', 'health', 'cuisineType', 'mealType']));
        if(count($response->hits)){
            $updatedAt = \Illuminate\Support\Carbon::now();

            collect($response->hits)
                ->map(function ($row) use ($updatedAt){
                    $fileName = 'recipes/'.current(explode('?', last(explode('/',$row->recipe->image))));
                    if(!Storage::disk('public')->exists($fileName)){
                        Storage::disk('public')->put($fileName, file_get_contents($row->recipe->image));
                    }
                    return [
                        'name' => $row->recipe->label,
                        'slug' => SlugService::createSlug(\App\Models\Recipe::class, 'slug', $row->recipe->label),
                        'diet_labels' => json_encode($row->recipe->dietLabels),
                        'health_labels' => json_encode($row->recipe->healthLabels),
                        'calories' => $row->recipe->calories,
                        'image' => $fileName,
                        'cautions' => json_encode($row->recipe->cautions),
                        'ingredients' => json_encode($row->recipe->ingredientLines),
                        'cuisine_type' => json_encode($row->recipe->cuisineType),
                        'meal_type' => json_encode($row->recipe->mealType),
                        'dish_type' => json_encode($row->recipe->dishType),
                        'nutrients' => json_encode($row->recipe->totalNutrients),
                        'total_time' => $row->recipe->totalTime,
                        'weight' => $row->recipe->totalWeight,
                        'source' => $row->recipe->source,
                        'price' => fake()->numberBetween(2000,20000),
                        'created_at'  => \Illuminate\Support\Carbon::now(),
                        'updated_at' => $updatedAt
                    ];
                })
                ->chunk(1000)
                ->each(function ($chunk) {

                    \Illuminate\Support\Facades\DB::table('recipes')->upsert(
                        $chunk->toArray(),
                        ['name', 'slug'],
                        ['calories','updated_at']
                    );
                });

            $this->recipes = \App\Models\Recipe::where('updated_at', $updatedAt)->get();
        }

//        $this->redirect(
//            route('recipes.index'),
//            navigate: true
//        );
//        event(new Registered($user = User::create($validated)));



    }
}; ?>

<div class="px-4 lg:px-0">
    <div class="container bg-white rounded-4xl py-5 my-5 p-5 lg:p-8">
        <h2 class="font-bold text-2xl mb-4">Search for your favorite recipe</h2>
        <form wire:submit.prevent="search" method="post" class="bg-white rounded-4xl">
            @csrf
            <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-6">
                <div class="">
                    <x-input wire:model="q" label="Search Query" placeholder="Search recipes..." />
                </div>
                <div class="">
                    <x-select
                        label="Diet"
                        placeholder="Select option"
                        multiselect
                        :options="$this->diets->toArray()"
                        wire:model="diet"
                    />
                </div>
                <div class="">
                    <x-select
                        label="Health"
                        placeholder="Select option"
                        multiselect
                        :options="$this->health_options->toArray()"
                        wire:model="health"
                    />
                </div>
                <div class="">
                    <x-select
                        label="Cuisine Type"
                        placeholder="Select option"
                        multiselect
                        :options="$this->cuisine_types->toArray()"
                        wire:model.defer="cuisineType"
                    />
                </div>
                <div class="">
                    <x-select
                        label="Meal Type"
                        placeholder="Select option"
                        multiselect
                        :options="$this->meal_types->toArray()"
                        wire:model.defer="mealType"
                    />
                </div>
                <div>
                    <x-label class="mb-1">&nbsp;</x-label>
                   <x-button type="submit" label="Search" class="w-full" spinner="search" primary/>
                </div>
            </div>

           <x-errors />
        </form>
    </div>
    @if($q)
    <div class="container bg-white rounded-4xl py-5 my-5">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
            @forelse($recipes as $recipe)
                <x-recipe.design-1 :recipe="$recipe"/>
            @empty
                <div class="lg:col-span-3">No record found.</div>
            @endforelse
        </div>
    </div>
    @endif
</div>
