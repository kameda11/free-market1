<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Exhibition;
use App\Models\User;


class ExhibitionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    public function definition()
    {
        $filenames = ['1.jpg', '2.jpg', '3.jpg', '4.jpg', '5.jpg', '6.jpg', '7.jpg', '8.jpg', '9.jpg', '10.jpg']; // 用意した画像名
        return [
            'name' => $this->faker->word(),
            'detail' => $this->faker->sentence(),
            'category' => '本',
            'product_image' => 'storage/products/' . $this->faker->randomElement($filenames),
            'condition' => 2,
            'price' => $this->faker->numberBetween(1000, 10000),
            'user_id' => \App\Models\User::factory(),
        ];
    }
}
