<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Http\Resources\RestaurantResources;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::get();

        return $this->okResponse('Restaurant retrieved successfuly', new RestaurantResources($restaurant));
    }

    public function show($id)
    {
        $restaurant = Restaurant::find($id);

        if($restaurant)
        {
            return $this->okResponse("restaurant gotten successfully", new RestaurantResources($restaurant));
        }

        return $this->notFoundResponse("restaurant not found");

    }
}
