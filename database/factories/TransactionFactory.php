<?php

namespace Database\Factories;

use App\Models\Transaction;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // ユーザーを自動生成
            'category_id' => Category::factory(), // カテゴリも自動生成
            'amount' => $this->faker->numberBetween(100, 10000),
            'date' => $this->faker->date(),
            'note' => $this->faker->optional()->sentence,
        ];
    }
}
