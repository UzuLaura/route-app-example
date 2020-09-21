<?php

use Illuminate\Database\Seeder;

class CarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cars')->insert([
            [
                'brand' => 'Test Car 1',
                'number' => 'TES123',
                'fuel_type' => 'dyzelinas',
                'driver' => 'Vardenis Pavardenis',
                'fuel_rate_summer' => '5.37',
                'fuel_rate_winter' => '5.37'
            ],
            [
                'brand' => 'Test Car 2',
                'number' => 'ABC123',
                'fuel_type' => 'benzinas',
                'driver' => 'Jonas Jonaitis',
                'fuel_rate_summer' => '9.32',
                'fuel_rate_winter' => '9.32'
            ]
        ]);
    }
}
