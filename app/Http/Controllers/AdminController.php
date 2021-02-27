<?php

namespace App\Http\Controllers;

use App\Order;
use App\Status;
use http\Cookie;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    //Restaurants
    public function index(){
        return view('admin.index')
            ->with('restaurants', RestaurantController::getAllRestaurants())
            ->with('cities', CityController::getAllCities())
            ->with('cuisines', CuisineController::getAllCuisines());
    }

    //Dishes
    public function dishes(){
        return view('admin.dishes')
            ->with('dishes', DishController::getAllDishes())
            ->with('restaurants', RestaurantController::getAllRestaurants());
    }

    //Cities & cuisines
    public function tables(){
        return view('admin.tables')
        ->with('cities', CityController::getAllCities())
        ->with('cuisines', CuisineController::getAllCuisines());
    }


    // Orders
    public function orders(){
        return view('admin.orders')
        ->with('orders', OrderController::getAllOrders())
        ->with('statuses', Status::all());
    }

    //Users
    public function users(){
        return view('admin.users')
            ->with('users', UserController::getAllUsers());
    }

}
