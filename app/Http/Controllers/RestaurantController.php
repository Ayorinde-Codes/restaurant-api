<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Restaurant;

class RestaurantController extends Controller
{
    public function index()
    {
        $restaurant = Restaurant::get();

        return $this->okResponse('Restaurant retrieved successfuly', $restaurant);
    }
}
