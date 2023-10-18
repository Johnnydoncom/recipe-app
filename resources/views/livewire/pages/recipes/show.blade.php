<?php

use Livewire\Volt\Component;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
use App\Models\Recipe;

new #[Layout('layouts.app')] class extends Component
{
    public $recipe, $openModal=false;

    public function mount($slug){
        $this->recipe = Recipe::whereSlug($slug)->firstOrFail();
    }
}; ?>

<div>
    <div x-data="{openModal: @entangle('openModal')}" class="container py-5 my-5">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-6">
            <div class="relative">
                <img src="{{ Storage::url($recipe->image) }}" class="w-full h-full object-cover rounded-2xl" alt="{{ $recipe->name }}">
                <p class="absolute top-2 left-2 bg-primary text-xs lg:text-sm mb-2 text-white p-1 px-2 rounded-2xl">{{$recipe->source}}</p>
            </div>
            <div class="bg-white rounded-4xl p-5">
                <div class="flex flex-col gap-2 justify-between h-full py-2">
                    <div>
                        <h2 class="font-semibold text-2xl lg:text-2xl">{{ $recipe->name }}</h2>
                        <div class="flex flex-wrap gap-2 text-xs lg:text-sm mb-2">
                            @if($recipe->calories)
                            <span>
                                Calories: <span class="text-primary">{{number_format($recipe->calories,2)}}</span>
                            </span>
                            @endif
                            @if(count($recipe->cuisine_type))
                            <span>
                                Cuisine:
                                @foreach($recipe->cuisine_type as $ctype)
                                    <a href="#" class="text-primary">{{\Illuminate\Support\Str::ucfirst($ctype)}}
                                        @unless($loop->last) , @endunless
                                    </a>
                                @endforeach
                            </span>
                            @endif

                            @if(count($recipe->meal_type))
                            <span>
                                Meal Type:
                                @foreach($recipe->meal_type as $mtype)
                                    <a href="#" class="text-primary">{{\Illuminate\Support\Str::ucfirst($mtype)}}
                                        @unless($loop->last) , @endunless
                                    </a>
                                @endforeach
                                </span>
                            @endif

                            @if(count($recipe->dish_type))
                            <span>
                                Dish Type:
                              @foreach($recipe->dish_type as $dtype)
                                <a href="#" class="text-primary">{{\Illuminate\Support\Str::ucfirst($dtype)}}
                                    @unless($loop->last) , @endunless
                                </a>
                              @endforeach
                            </span>
                            @endif

                        </div>


                        <h2 class="font-bold text-2xl lg:text-3xl mb-4">{{currency($recipe->price)}}</h2>
                        <div>
                            <h3 class="text-base font-semibold mb-2 text-primary uppercase">Ingredients</h3>
                            <ul class="text-xs grid grid-cols-2 gap-2">
                               @foreach($recipe->ingredients as $ingredient)
                                <li>{{$ingredient}}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    <x-button @click="openModal = !openModal" primary>View Price in USD</x-button>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-4xl p-5">
            <div class="flex flex-col lg:flex-row gap-4 lg:gap-14">
                <div class="w-full lg:w-1/3 ">
                    <div class="bg-primary-500 rounded-xl p-4">
                        <h3 class="text-base font-semibold text-white uppercase">Health Info</h3>
                        <p class="text-sm text-gray-200 mb-2">This information is per serving.</p>
                        <ul class="text-sm grid grid-cols-2 gap-2 lg:gap-2 bg-white p-2">
                            @foreach($recipe->health_labels as $health)
                            <li>
                                {{$health}}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="w-full lg:w-2/3">
                    <h3 class="text-base font-semibold mb-2 text-primary uppercase">Nutrition Facts</h3>
                    <div class="grid grid-cols-2 lg:grid-cols-3 gap-2 lg:gap-4">
                      @foreach($recipe->nutrients as $nutrient)
                        <div>
                            <p>{{$nutrient['label']}}</p>
                            <p class="text-gray-600 text-sm">{{round($nutrient['quantity'], 1).$nutrient['unit']}}</p>
                        </div>
                      @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div x-show="openModal" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-center justify-center min-h-screen px-4 text-center md:items-center sm:p-0">
                <div x-cloak @click="openModal=false" x-show="openModal"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0"
                     x-transition:enter-end="opacity-100"
                     x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="opacity-100"
                     x-transition:leave-end="opacity-0"
                     class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-50" aria-hidden="true"
                ></div>

                <div x-cloak x-show="openModal"
                     x-transition:enter="transition ease-out duration-300 transform"
                     x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave="transition ease-in duration-200 transform"
                     x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                     x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                     class="inline-block w-full max-w-sm my-5d inset-y-0 text-left transition-all transform lg:max-w-sm relative"
                >
                    <div class="rounded-xl bg-white overflow-hidden p-4 lg:p-5 space-y-4 my-5 shadow-xl">
                        <div class="flex flex-col items-center justify-center text-center gap-4">
                            <div class="rounded-lg p-4 text-primary border border-primary">
                                <svg class="w-10 h-10" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path clip-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12zm13.36-1.814a.75.75 0 10-1.22-.872l-3.236 4.53L9.53 12.22a.75.75 0 00-1.06 1.06l2.25 2.25a.75.75 0 001.14-.094l3.75-5.25z" fill-rule="evenodd"></path>
                                </svg>
                            </div>
                            <h2 class="font-bold text-2xl lg:text-4xl mb-4">{{currency($recipe->price, currency()->getUserCurrency(), 'USD')}}</h2>

                            <button type="button" class="btn btn-secondary btn-block mt-8" @click="openModal = false">
                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path clip-rule="evenodd" d="M7.72 12.53a.75.75 0 010-1.06l7.5-7.5a.75.75 0 111.06 1.06L9.31 12l6.97 6.97a.75.75 0 11-1.06 1.06l-7.5-7.5z" fill-rule="evenodd"></path>
                                </svg>
                                Close
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
