<?php

namespace Database\Seeders;

use App\Models\City;
use App\Models\Data;
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
        $city= City::create([
            'name' => 'balikpapan',
            'area' => 'sepinggan',
        ]);
        $package= Packages::create([
            'name' => 'hemat banget',
            'price' => 100000,
            'speed' => 20,
            'device' => 3,
            'city_id' => $city->id
        ]);
        Data::create([
            'name' => 'daffa',
            'email' => 'daffa@gmail.com',
            'number' => '081927384123',
            'address' => 'sepinggna balikpapan rt29 jalan sudirman',
            'package_id' => $package->id
        ]);
    }
}
