<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create();

        return [
            'user_id' => $user->id,
            'product_name' => $product->name,
            'content' => $this->faker->text(200)
        ];
    }
}
