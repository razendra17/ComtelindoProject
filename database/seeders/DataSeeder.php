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
            'name' => 'Samarinda',
            'area' => 'kalimantan Timur',
            'latitude' => -0.502106,
            'longitude' => 117.153709,
        ]);
        City::create([
            'name' => 'Jakarta',
            'area' => 'Jawa Barat',
            'latitude' =>  -6.200000,
            'longitude' => 106.816666,
        ]);
        City::create([
            'name' => 'Tenggarong',
            'area' => 'kalimantan Timur',
            'latitude' => -0.4329135,
            'longitude' => 116.989678,
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
            'city_id' => 3
        ]);
        $package = Package::create([
            'name' => 'Intynet Starter',
            'price' => 149000,
            'speed' => 10,
            'device' => 3,
            'city_id' => 3
        ]);
        $package = Package::create([
            'name' => 'Intynet Ultima',
            'price' => 380000,
            'speed' => 100,
            'device' => 15,
            'city_id' => 4
        ]);
    }
}
