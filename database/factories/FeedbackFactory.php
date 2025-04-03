<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Feedback;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\feedback>
 */
class FeedbackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Feedback::class;
    public function definition(): array
    {
        return [
            "idCustomer" =>$this->faker->numberBetween(1,10),
            "content"=> $this->faker->paragraph(),
        ];
    }
}
