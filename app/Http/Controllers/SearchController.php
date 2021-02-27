<?php

namespace App\Http\Controllers;

use App\City;
use App\Restaurant;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    public function search(Request $request)
    {
        $search = $request->search;
        return view('restaurant.restaurants', [
            'restaurants' => Restaurant::where('name', 'like', '%' . $search . '%')
                ->latest()
                ->paginate(6)
                ->setPath('')
                ->appends([
                    'search' => $search
                ]),
            'characterSearch' => $search
        ], ['cities'=> CityController::getAllCities()]);
    }

    public function getSearchOptionsAjax(Request $request)
    {
        $restaurants = Restaurant::where('name', 'like', '%' . $request->value . '%')
            ->take(5)
            ->get();
        $firstFive = '';
        foreach ($restaurants as $restaurant){
            $firstFive .= '<li><a href="javascript:void(0)" onclick="submit(\''.$restaurant->name.'\')">'.$restaurant->name.'</a></li>';
        }
        return response()->json([
            'result' => $firstFive,
        ]);
    }
}


