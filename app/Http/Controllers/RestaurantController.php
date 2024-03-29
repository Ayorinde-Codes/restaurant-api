<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Http\Resources\RestaurantResources;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::all();

        return $this->okResponse('Restaurant retrieved successfuly', new RestaurantResources($restaurant));
    }

    public function show($id)
    {
        $restaurant = Restaurant::find($id);

        if ($restaurant) {
            return $this->okResponse("restaurant gotten successfully", new RestaurantResources($restaurant));
        }

        return $this->notFoundResponse("restaurant not found");
    }

    public function update(Request $request, $id)
    {
        $restaurant = Restaurant::find($id);

        if ($restaurant) {
            $restaurant->update($request->all());
            return $this->okResponse("restaurant updated successfully", new RestaurantResources($restaurant));
        }
        return $this->notFoundResponse("restaurant not found");
    }

    public function create(Request $request)
    {
        $restaurant = Restaurant::create($request->all());

        return $this->createdResponse("restaurant created successfully", new RestaurantResources($restaurant));
    }
}
