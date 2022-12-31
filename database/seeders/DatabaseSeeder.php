<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Condition;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    private int $productCounts = 180;

    /**
     * Seed the application's database.
     * @return void
     */
    public function run()
    {
        DB::table('conditions')->insert(
            array_map(function ($condition) {
                return [
                    'name' => $condition['name'],
                    'slug' => $condition['slug']
                ];
            }, config('conditions'))
        );
        
        /**
         * @var Collection<int,Product>
         */
        $products = Product::factory($this->productCounts)->create();

        Category::factory(15)->create()->each(
            function ($cat) use ($products) {
                $cat->products()->attach(
                    $products->random(random_int(1, $this->productCounts / 2))
                        ->pluck('id')
                        ->toArray()
                );
            }
        );

    }
}
