<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::view('/', 'welcome');
Volt::route('/', 'welcome.welcome')->name('index');

// Recipes
Volt::route('recipes', 'pages.recipes.recipes')->name('recipes.index');
Volt::route('recipes/{slug}', 'pages.recipes.show')->name('recipes.show');

// Users
Volt::route('users', 'pages.users.users')->name('users.index');
Volt::route('users/{slug}', 'pages.users.show')->name('users.show');

// Recipes
Volt::route('restaurants', 'pages.restaurants.restaurants')->name('restaurants.index');
//Volt::route('restaurants/{slug}', 'pages.recipes.show')->name('recipes.show');

Route::get('test-recipes', function (){
    $apiServie= new \App\Services\RecipeService();
    return $apiServie->recipes(['q'=>'beans']);
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
