<?php
namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class RentalController extends Controller
{
    public function index()
    {
        $rentals = Rental::all();

        return response()->json(['rentals' => $rentals], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'carId' => 'required|exists:cars,id',
            'rental_start_date' => 'required|date',
            'rental_end_date' => 'required|date',
        ]);
    
        $car = Car::find($validatedData['carId']);
        
        if ($car) {
            $user = auth()->user();
            $rental = new Rental();
            $rental->user_id =$request->user_id;
            $rental->car_id = $car->id;
            $rental->rental_start_date = $validatedData['rental_start_date'];
            $rental->rental_end_date = $validatedData['rental_end_date'];
            $rental->save();
    
            return response()->json(['message' => 'Car rented successfully'], 201);
        }
    
        return response()->json(['message' => 'Failed to rent the car'], 400);
    }

    public function show(Rental $rental)
    {
        return response()->json(['rental' => $rental], 200);
    }

    public function update(Request $request, Rental $rental)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'car_id' => 'required|exists:cars,id',
            'rental_start_date' => 'required|date',
            'rental_end_date' => 'required|date',
        ]);

        $rental->update($validatedData);

        return response()->json(['rental' => $rental], 200);
    }

    public function destroy(Rental $rental)
    {
        $rental->delete();

        return response()->json(['message' => 'Rental deleted successfully'], 200);
    }
}
