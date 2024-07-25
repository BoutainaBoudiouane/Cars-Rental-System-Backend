<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents; 
use Illuminate\Database\Seeder;
use App\Models\Rental;
use App\Models\User;
use App\Models\Car;
use Carbon\Carbon;

class RentalSeeder extends Seeder
{
    public function run()
    {
        // Assuming the user with ID 1 exists
        $user = User::find(1);
        
        // Assuming the cars with IDs 1, 2, 3, 4 exist
        $cars = Car::whereIn('id', [1, 2])->get();
        
        foreach ($cars as $car) {
            $rentalData = [
                'user_id' => $user->id,
                'car_id' => $car->id,
                'rental_start_date' => Carbon::now(),
                'rental_end_date' => Carbon::now()->addDays(7),
            ];
            
            $rental = Rental::create($rentalData);
        }
    }
}
