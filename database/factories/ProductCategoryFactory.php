<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\ProductCategory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductCategory>
 */
class ProductCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = ProductCategory::class;
    public function definition(): array
    {
        return [
            "name"=>fake()->name(10),
            "sort"=>fake()->unique()->numberBetween(1,5),
            "status"=>fake()->numberBetween(0,1),
            "parentId"=>fake()->randomElement([null,fake()->numberBetween(1,5)]),
            "createdBy"=>$this->faker->numberBetween(1,10),
            "createdDate"=> $this->faker->dateTime()->format('Y-m-d H:i:s'),
            "updatedBy"=>$this->faker->numberBetween(1,10),
            "updatedDate"=> $this->faker->dateTime()->format('Y-m-d H:i:s'),

        ];
    }
}
