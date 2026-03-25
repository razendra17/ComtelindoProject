<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Data;
use App\Models\Package;
use App\Models\Packages;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        City::create([
            'name' => 'Balikpapan',
            'area' => 'kalimantan Timur',
            'latitude' => -1.269160,
            'longitude' => 116.825264,
        ]);

        City::create([
            'name' => 'Bontang',
            'area' => 'kalimantan Timur',
            'latitude' => 0.133333,
            'longitude' =>  117.500000,
        ]);

        $package = Package::create([
            'name' => 'Intynet Maxima',
            'price' => 299000,
            'speed' => 50,
            'device' => 10,
            'city_id' => 1
        ]);
        $package = Package::create([
            'name' => 'Intynet Family',
            'price' => 249000,
            'speed' => 30,
            'device' => 5,
            'city_id' => 2
        ]);
        $package = Package::create([
            'name' => 'Intynet Smart',
            'price' => 199000,
            'speed' => 20,
            'device' => 3,
            'city_id' => 1
        ]);
        $package = Package::create([
            'name' => 'Intynet Starter',
            'price' => 149000,
            'speed' => 10,
            'device' => 3,
            'city_id' => 2
        ]);
        $package = Package::create([
            'name' => 'Intynet Ultima',
            'price' => 380000,
            'speed' => 100,
            'device' => 15,
            'city_id' => 1
        ]);
    }
}
