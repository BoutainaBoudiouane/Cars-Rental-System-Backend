<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;


class CarSeeder extends Seeder
{
    public function run()
    {
        $cars = [
            [
                'brand' => 'Mercedes',
                'model' => 'Cruze',
                'year' => 2018,
                'color' => 'White',
                'rental_price' => 40.00,
                'available' => true,
                'image' => 'car1.jpg',
            ],
            [
                'brand' => 'Audi',
                'model' => 'A4',
                'year' => 2020,
                'color' => 'White',
                'rental_price' => 60.00,
                'available' => true,
                'image' => 'car2.jpg',
            ],
            [
                'brand' => 'Mercedes',
                'model' => 'Camry',
                'year' => 2019,
                'color' => 'Black',
                'rental_price' => 50.00,
                'available' => true,
                'image' => 'car3.jpg',
            ],
            [
                'brand' => 'Mercedes',
                'model' => 'Accord',
                'year' => 2021,
                'color' => 'Orange',
                'rental_price' => 45.00,
                'available' => true,
                'image' => 'car4.jpg',
            ],
            [
                'brand' => 'Mercedes-Benz',
                'model' => 'G-class',
                'year' => 2019,
                'color' => 'Black',
                'rental_price' => 80.00,
                'available' => true,
                'image' => 'car5.jpg',
            ],
            [
                'brand' => 'BMW',
                'model' => 'M5',
                'year' => 2020,
                'color' => 'Blue',
                'rental_price' => 75.00,
                'available' => true,
                'image' => 'car6.jpg',
            ],
            [
                'brand' => 'Chevrolet',
                'model' => 'Camaro5',
                'year' => 2017,
                'color' => 'Orange',
                'rental_price' => 55.00,
                'available' => true,
                'image' => 'car7.jpg',
            ],
            [
                'brand' => 'Chevrolet',
                'model' => 'Camaro8',
                'year' => 2022,
                'color' => 'Blue',
                'rental_price' => 48.00,
                'available' => true,
                'image' => 'car8.jpg',
            ],
            [
                'brand' => 'Lamborghini',
                'model' => 'Aventador',
                'year' => 2019,
                'color' => 'Silver',
                'rental_price' => 95.00,
                'available' => true,
                'image' => 'car9.jpg',
            ],
           
        ];
        foreach ($cars as $car) {
            $imagePath = 'images/'.$car['image'];
            $storedImagePath = Storage::disk('public')->putFile('images', public_path($imagePath));
    
            Car::create([
                'brand' => $car['brand'],
                'model' => $car['model'],
                'year' => $car['year'],
                'color' => $car['color'],
                'rental_price' => $car['rental_price'],
                'available' => $car['available'],
                'image' => $storedImagePath,
            ]);
        }
    }
}

