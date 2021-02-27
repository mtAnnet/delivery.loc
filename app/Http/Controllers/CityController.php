<?php

namespace App\Http\Controllers;
use App\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CityController extends Controller
{
    //Возвращает все города
    public static function getAllCities(){
        return City::all();
    }

    //Создает новый город и записывает его в бд
    public function create(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'newCity' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect(route('admin.tables'))
                ->withErrors($validator)
                ->withInput();
        }
        else {
            $city = new City();
            $city->name = $data['newCity'];
            $city->save();
            return redirect(route('admin.tables'));
        }
    }

    //Удаляет город по id
    public function delete($id){
        $city = City::find($id);
        $city->delete();
        return redirect(route('admin.tables'));
    }

    //Ищет город по названию
    public function search(Request $request){
        $searchQuery = $request->adminCitySearch;
        if(!empty($searchQuery))
        {
            $cuisines = CuisineController::getAllCuisines();
            $cities = City::where('name', 'LIKE', '%' . $searchQuery. '%')->get();
            return view('admin.tables')
                ->with('cuisines', $cuisines)
                ->with('cities', $cities);
        }
        else {
            return redirect(route('admin.tables'));
        }
    }
}
