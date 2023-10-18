<?php

namespace App\Services;

class RecipeService
{
    private $apiKey = '9faece844394d9324d287735ea942e66';
    private $appId = '1d0a9810';
    private $baseUrl = 'https://api.edamam.com/api/recipes/v2';

    public function recipes(array $payload=[]){
        $payload['type'] = 'public';
        $payload['app_id'] = $this->appId;
        $payload['app_key'] = $this->apiKey;

        $response = \Illuminate\Support\Facades\Http::withHeaders([
            'accept' => 'application/json',
            "Content-Type: application/json"
        ])->retry(3, 100, throw: false)->get($this->baseUrl, $payload);

        return $response->object();
    }

    public static function diets(){
        return collect([
            'balanced' => 'Balanced',
            'high-fiber' => 'High fiber',
            'high-protein' => 'High protein',
            'low-carb' => 'Low carb',
            'low-fat' => 'Low fat',
            'low-sodium' => 'Low sodium'
        ]);
    }

    public static function healthOptions(){
        return collect([
            'alcohol-cocktail' => 'Alcohol-cocktail',
            'alcohol-free' => 'Alcohol-free',
            'celery-free' => 'celery-free',
            'crustacean-free' => 'crustacean-free',
            'dairy-free' => 'dairy-free',
            'DASH' => 'DASH',
            'egg-free' => 'egg-free',
            'fish-free' => 'fish-free',
            'fodmap-free' => 'fodmap-free',
            'gluten-free' => 'gluten-free',
            'immuno-supportive' => 'immuno-supportive',
            'keto-friendly' => 'keto-friendly',
            'kidney-friendly' => 'kidney-friendly',
            'kosher' => 'kosher',
            'low-fat-abs' => 'low-fat-abs',
            'low-potassium' => 'low-potassium',
            'low-sugar' => 'low-sugar',
            'lupine-free' => 'lupine-free',
            'Mediterranean' => 'Mediterranean',
            'mollusk-free' => 'mollusk-free',
            'mustard-free' => 'mustard-free',
            'no-oil-added' => 'no-oil-added',
            'paleo' => 'paleo',
            'peanut-free' => 'peanut-free',
            'pescatarian' => 'pescatarian',
            'pork-free' => 'pork-free',
            'red-meat-free' => 'red-meat-free',
            'sesame-free' => 'sesame-free',
            'shellfish-free' => 'shellfish-free',
            'soy-free' => 'soy-free',
            'sugar-conscious' => 'sugar-conscious',
            'sulfite-free' => 'sulfite-free',
            'tree-nut-free' => 'tree-nut-free',
            'vegan' => 'vegan',
            'vegetarian' => 'vegetarian',
            'wheat-free' => 'wheat-free'
        ]);
    }

    public static function cuisines(){
        return collect([
            'American' => 'American',
            'Asian' => 'Asian',
            'British' => 'British',
            'Caribbean' => 'Caribbean',
            'Central Europe' => 'Central Europe',
            'Chinese' => 'Chinese',
            'Eastern Europe',
            'French' => 'French',
            'Indian' => 'Indian',
            'Italian' => 'Italian',
        ]);
    }

    public static function meals(){
        return collect([
            'Breakfast' => 'Breakfast',
            'Dinner' => 'Dinner',
            'Lunch' => 'Lunch',
            'Snack' => 'Snack',
            'Teatime' => 'Teatime'
        ]);
    }

    public static function dishes(){
        return collect([
            'Biscuits and cookies' => 'Biscuits and cookies',
            'Bread' => 'Bread',
            'Cereals' => 'Cereals',
            'Condiments and sauces' => 'Condiments and sauces',
            'Desserts' => 'Desserts',
            'Drinks',
            'Main course',
            'Pancake',
            'Preps',
            'Preserve',
            'Salad',
            'Sandwiches',
            'Side dish',
            'Soup',
            'Starter',
            'Sweets'
        ]);
    }
}
