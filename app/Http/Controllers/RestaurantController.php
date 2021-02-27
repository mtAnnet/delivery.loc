<?php

namespace App\Http\Controllers;

use App\City;
use App\Cuisine;
use App\Dish;
use App\Restaurant;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    public function index(){
        $restaurants = Restaurant::with('cuisines', 'cities')
            ->latest()
            ->paginate('6');
        $cities = CityController::getAllCities();
        return view('restaurant.restaurants', ['restaurants'=>$restaurants], ['cities'=>$cities]);
    }

    public function restaurant($slug){
        $restaurant  = Restaurant::with( 'cuisines', 'dishes', 'cities')
            ->where('slug', '=', $slug)
            ->first();
        return view('restaurant.restaurant_dishes', ['restaurant'=>$restaurant]);
    }

    public static function getAllRestaurants()
    {
        $restaurants = Restaurant::with('cities', 'cuisines')->get();
        return $restaurants;
    }

    public static function addNewRestaurant(Request $request){
        $data = $request->all();
        $image = $request->image->store('uploads', 'public');
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect(route('create_post'))
                ->withErrors($validator)
                ->withInput();
       }
        $restaurant = new Restaurant();
        $restaurant->name = $data['name'];
        $restaurant->image = $image;
        $restaurant->save();
        $restaurant->relationRestaurantCity($data['cities']);
        $restaurant->relationRestaurantCuisine($data['cuisines']);
        return redirect(route('admin.index'));
    }
    public function findRestaurantsByName(Request $request){
        $searchQuery = $request->restaurantSearchByName;
        if(!empty($searchQuery))
        {
            $restaurants = Restaurant::with('cuisines', 'cities')
                ->where('name', 'LIKE', '%' . $searchQuery. '%')
                ->get();
            return view('admin.index')
                ->with('dishes',DishController::getAllDishes())
                ->with('restaurants',$restaurants)
                ->with('cuisines',CuisineController::getAllCuisines())
                ->with('cities', CityController::getAllCities());
        }
        else
        {
            return redirect(route('admin.index'));
        }
    }
    public function filterCity(Request $request){

        $restaurants = Restaurant::with('cuisines', 'cities')
            ->whereHas('cities', function (Builder $query) use ($request) {
                $query->where('city_id', $request->city);
            })->latest()
            ->paginate(6);
        $cities = CityController::getAllCities();
        return view('restaurant.restaurants', ['restaurants'=>$restaurants], ['cities'=>$cities]);
    }
    public function deleteRestaurant($id){
        $restaurant = Restaurant::find($id);
        $restaurant->delete();
        return redirect(route('admin.index'));
    }

}
