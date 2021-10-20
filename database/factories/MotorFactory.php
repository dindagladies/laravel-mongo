<?php

namespace Database\Factories;

use Faker\Generator as Faker;
use App\Models\Motor;
use Illuminate\Database\Eloquent\Factories\Factory;

class MotorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Motor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nama' => $faker->sentence,
            'mesin' => $faker->sentence,
            'tipe_suspensi' => $faker->sentence,
            'tipe_tranmisi' => $faker->sentence,
            'stock' => 4,
            'id_kendaraan' => 1,
        ];
    }
}
