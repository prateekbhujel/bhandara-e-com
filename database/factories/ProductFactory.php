<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [];

        for($i = 1; $i < rand(2, 6); $i++) {                
            $filename = "img" . date('YmidHis') . rand(1000, 9999) . ".jpg";
            
            $img = (new Image(new Driver))->read(public_path("img" . rand(1, 6) . ".jpg"));

            $img->scaleDown(1280, 720)->save(storage_path("app/public/images/$filename"));
            
            $images[] = $filename;
        }

        return [
            'name'        => fake()->name(),
            'summary'     => fake()->realTextBetween(500, 800),
            'details'     => fake()->paragraphs(3, true),
            'price'       => rand(500, 5000000),
            'category_id' => Category::select('id')->inRandomOrder()->first()->id,
            'brand_id'    => Brand::select('id')->inRandomOrder()->first()->id,
            'images'      => $images,
        ];
    }
}
