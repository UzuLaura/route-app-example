<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Schools
Route::get('schools', 'SchoolsController@getSchools');
Route::post('school/edit/{id}', 'SchoolsController@editSchool');

// Cars
Route::get('cars', 'CarsController@getCars');
Route::get('car/{id}', 'CarsController@getCar');
Route::post('car/edit/{id}', 'CarsController@editCar');

// Dates
Route::get('dates', 'DateController@getDates');

// Routes
Route::post('routes/find', 'RoutesController@checkIfRoutesDataExist');
Route::post('routes/validate', 'RoutesController@validateRoute');
Route::post('routes/save', 'RoutesController@saveRoutes');
Route::post('routes/info/save', 'RoutesController@saveRoutesInfo');
Route::post('routes/search', 'RoutesController@searchRoutes');

// Generator
Route::post('generate', 'GenerationController@generateRoutes');