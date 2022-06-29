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
}
