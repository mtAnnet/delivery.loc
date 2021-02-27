<?php

namespace App\Http\Controllers;
use App\Cuisine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CuisineController extends Controller
{
    //Возвращает все кухни
    public static function getAllCuisines(){
        return Cuisine::all();
    }

    //Создает новую кухню и добавляет ее в бд
    public function create(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'newCuisine' => 'required|max:255',
        ]);
        if ($validator->fails()) {
            return redirect(route('admin.tables'))
                ->withErrors($validator)
                ->withInput();
        }
        else{
            $cuisine = new Cuisine();
            $cuisine->name = $data['newCuisine'];
            $cuisine->save();
            return redirect(route('admin.tables'));
        }
    }

    //Удаляет кухню
    public function delete($id){
        $cuisine = Cuisine::find($id);
        $cuisine->delete();
        return redirect(route('admin.tables'));
    }

    //Ищет кухню по названию
    public function search(Request $request){
        $searchQuery = $request->adminCuisineSearch;
        if(!empty($searchQuery))
        {   $cities = CityController::getAllCities();
            $cuisines = Cuisine::where('name', 'LIKE', '%' . $searchQuery. '%')->get();
            return view('admin.tables')
                ->with('cuisines', $cuisines)
                ->with('cities', $cities);
        }
        else {
            return redirect(route('admin.tables'));
        }
    }
}
