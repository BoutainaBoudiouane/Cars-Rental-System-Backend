<?php
namespace App\Http\Controllers;
//namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Rental;
use App\Models\Car;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return response()->json(['users' => $users], 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);

        $user = User::create($validatedData);

        return response()->json(['user' => $user], 201);
    }

    public function show(User $user)
    {
        return response()->json(['user' => $user], 200);
    }

    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'required',
        ]);

        $user->update($validatedData);

        return response()->json(['user' => $user], 200);
    }
    public function getRentedCars(User $user)
    {
       // $user = auth()->user();
        //$user = $request->user; 
        
        $rentedCars = Car::join('rentals','cars.id','=' ,'rentals.car_id')->where('user_id',$user->id)->get();
        //Rental::select('car_id')->where('user_id',$user->id)->get()->toArray(); 
        return response()->json(['rentedCars' => $rentedCars], 200);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return response()->json(['message' => 'User deleted successfully'], 200);
    }
}
