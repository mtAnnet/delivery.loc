<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

//Route for a default page
Route::middleware(['user'])->group(function (){
    Route::get('/','RestaurantController@index');
    //routes for content
    Route::get('/restaurants', 'RestaurantController@index')->name('restaurants');
    Route::get('/{restaurant_slug}/dishes', 'RestaurantController@restaurant')->name('restaurant_dishes');

//Routes for basket
    Route::get('/basket/index', 'BasketController@index')->name('basket.index');
    Route::post('/basket/add/{id}', 'BasketController@add')->name('basket.add');
    Route::post('/basket/plus/{id}', 'BasketController@plus')->name('basket.plus');
    Route::post('/basket/minus/{id}', 'BasketController@minus')->name('basket.minus');
    Route::post('/basket/remove/{id}', 'BasketController@remove')->name('basket.remove');
    Route::post('/basket/clear', 'BasketController@clear')->name('basket.clear');
    //Routes for search
    Route::any('/search', 'SearchController@search')->name('article_search');
    Route::post('/search-ajax', 'SearchController@getSearchOptionsAjax')->name('SearchOptions');
    Route::any('/search-by-city', 'RestaurantController@filterCity')->name('index.filter.city');
});

Route::middleware(['auth', 'user'])->group(function (){
    Route::get('/basket/checkout', 'BasketController@checkout')->name('basket.checkout');
    Route::post('/basket/saveorder', 'BasketController@saveOrder')->name('basket.saveorder');
    Route::get('/basket/success', 'BasketController@success')->name('basket.success');
    Route::post('likes', 'LikeController@actionLike')->name('actionLike');
    Route::any('/my-orders', 'OrderController@userOrders')->name('user.orders');
});

// Admin routes
Route::group(['prefix' => 'admin'], function() {
    Route::group(['middleware' => 'admin'], function() {

        Route::get('/', 'AdminController@index')->name('admin.index');
        Route::post('/restaurant-add', 'RestaurantController@addNewRestaurant')->name('admin.restaurants.create');
        Route::post('/restaurant-delete/{id}', 'RestaurantController@deleteRestaurant')->name('admin.restaurants.delete');
        Route::post('/restaurant-search-name-result', 'RestaurantController@findRestaurantsByName')->name('admin.restaurants.search.name');

        Route::get('/dishes-table', 'AdminController@dishes')->name('admin.dishes');
        Route::post('/dish-add', 'DishController@addNewDish')->name('admin.dishes.create');
        Route::post('/dish-delete/{id}', 'DishController@delete')->name('admin.dishes.delete');
        Route::post('/dish-search-name-result', 'DishController@searchByName')->name('admin.dishes.search.name');

        Route::get('/users-table', 'AdminController@users')->name('admin.users');
        Route::any('/users/search-result', 'UserController@findUsers')->name('admin.users.search');
        Route::post('/users/delete/{id}', 'UserController@deleteUser')->name('admin.users.delete');

        Route::get('/orders-table', 'AdminController@orders')->name('admin.orders');
        Route::any('/orders/info/{id}', 'OrderController@info')->name('admin.orders.info');
        Route::post('/orders/done/{id}', 'StatusController@done')->name('admin.orders.done');
        Route::post('/orders/cancel/{id}', 'StatusController@cancel')->name('admin.orders.cancel');
        Route::post('/orders/filter', 'OrderController@filter')->name('admin.orders.filter');

        Route::get('/cities-cuisines-tables', 'AdminController@tables')->name('admin.tables');
        Route::post('/tables/cuisine-search-result', 'CuisineController@search')->name('admin.tables.cuisine.search');
        Route::post('/tables/cuisine-delete/{id}', 'CuisineController@delete')->name('admin.tables.cuisine.delete');
        Route::post('/tables/cuisine-add', 'CuisineController@create')->name('admin.tables.cuisine.add');
        Route::post('/tables/city-search-result','CityController@search')->name('admin.tables.city.search');
        Route::post('/tables/city-delete/{id}', 'CityController@delete')->name('admin.tables.city.delete');
        Route::post('/tables/city-add', 'CityController@create' )->name('admin.tables.city.add');
    });
});

