<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Car;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        
        return response()->json(['cars' => $cars], 200);
    }

    public function store(Request $request)
    {
        // Validate the form fields
        $validatedData = $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|numeric',
            'color' => 'required',
            'rental_price' => 'required|numeric',
            'available' => 'required|boolean',
            'image' => 'nullable|image|max:2048', // Validate image file if present (optional)
        ]);

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }
        


        // Create a new car instance
        $car = new Car;
        $car->brand = $validatedData['brand'];
        $car->model = $validatedData['model'];
        $car->year = $validatedData['year'];
        $car->color = $validatedData['color'];
        $car->rental_price = $validatedData['rental_price'];
        $car->available = $validatedData['available'];
        $car->image = $imagePath;
        $car->save();

        return response()->json(['car' => $car], 201);
    }

    public function show($carId)
{
    $car = Car::findOrFail($carId);

    return response()->json($car);
}


    public function update(Request $request, Car $car)
    {
        // Validate the form fields
        $validatedData = $request->validate([
            'brand' => 'required',
            'model' => 'required',
            'year' => 'required|numeric',
            'color' => 'required',
            'rental_price' => 'required|numeric',
            'available' => 'required|boolean',
            'image' => 'nullable|image|max:2048', // Validate image file if present (optional)
        ]);

        // Handle image upload
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            // Delete the previous image file if it exists
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }

            $imagePath = $request->file('image')->store('cars', 'public');
        } else {
            $imagePath = $car->image;
        }

        // Update the car
        $car->brand = $validatedData['brand'];
        $car->model = $validatedData['model'];
        $car->year = $validatedData['year'];
        $car->color = $validatedData['color'];
        $car->rental_price = $validatedData['rental_price'];
        $car->available = $validatedData['available'];
        $car->image = $imagePath;
        $car->save();

        return response()->json(['car' => $car], 200);
    }

    public function destroy(Car $car)
    {
        // Delete the image file if it exists
        if ($car->image) {
            Storage::disk('public')->delete($car->image);
        }

        $car->delete();

        return response()->json(['message' => 'Car deleted successfully'], 200);
    }
}
