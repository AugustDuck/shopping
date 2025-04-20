<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
        protected $model = Product::class;
        public function definition(): array
        {
            return [
                "name" =>fake()->name(),
                "status"=> $this->faker->randomDigit(),
                "vat" => 10,
                "hot"=> $this->faker->dateTimeBetween('now','+ 7days'),
                "description"=>$this->faker->paragraph(2),
                "tagId"=>$this->faker->numberBetween(1,100),
                "viewCount"=>$this->faker->numberBetween(1,10000),
                "categoryId"=>1,
                "brandId"=>1,
                "supplierId"=>1,
                "createdBy"=>$this->faker->paragraph(1),
                "createdDate"=> $this->faker->dateTime()->format('Y-m-d H:i:s'),
                "updatedBy"=>$this->faker->paragraph(1),
                "updatedDate"=> $this->faker->dateTime()->format('Y-m-d H:i:s'),
            ];
        }
}
