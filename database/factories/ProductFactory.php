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
        $image = [];
        $filename = "";
        return [
            //
        ];
    }
}
