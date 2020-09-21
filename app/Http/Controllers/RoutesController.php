<?php

namespace App\Http\Controllers;

use App\Route;
use App\RouteInfo;
use Illuminate\Http\Request;

class RoutesController extends Controller
{
    /**
     * Return routes list and info by report date and car id.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function searchRoutes(Request $request)
    {
        return response()->json([
            'routes' =>
                Route::where('car_id', $request->car)
                    ->where('report_date', $request->date)
                    ->get(),

            'route_info' =>
                RouteInfo::where('car_id', $request->car)
                    ->where('date', $request->date)
                    ->get()
        ]);
    }

    /**
     * Check if routes for selected date are already saved in DB.
     * Return warning if routes exist.
     * Redirect to save action if routes don't exist.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkIfRoutesDataExist(Request $request)
    {
        if (Route::where('car_id', $request[0]['car_id'])->where('report_date', $request[0]['report_date'])->first()) {
            return response()->json(['warning' => 'Maršrutų duomenys pasirinktam automobiliui nurodytai datai jau egzistuoja ir bus perrašyti.']);
        }

        return $this->saveRoutes($request);
    }

    /**
     * Save routes data in DB for each route.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveRoutes(Request $request)
    {
        $this->deleteRoutes($request);

        foreach ($request->request as $key => $route) {
            $this->insertRoute($route);
        }

        return response()->json(['success' => 'Duomenys įrašyti!']);
    }

    /**
     * Delete all routes for selected date and car.
     *
     * @param Request $request
     */
    public function deleteRoutes(Request $request)
    {
        Route::where('report_date', $request[0]['report_date'])
            ->where('car_id', $request[0]['car_id'])
            ->delete();
    }

    /**
     * Insert or update route in DB for selected date and car.
     *
     * @param $route
     * @return mixed
     */
    private function insertRoute($route)
    {
        return Route::insert([
            'car_id' => $route['car_id'],
            'date' => $route['date'],
            'report_date' => $route['report_date'],
            'distance' => $route['distance'],
            'route' => $route['route'],
        ]);
    }

    /**
     * Save routes info.
     *
     * @param Request $request
     */
    public function saveRoutesInfo(Request $request)
    {
        $this->insertRouteInfo($request);
    }

    /**
     * Insert or update routes info in DB for selected car and month.
     *
     * @param Request $request
     * @return mixed
     */
    private function insertRouteInfo(Request $request)
    {
        return RouteInfo::updateOrInsert(
            [
                'car_id' => $request->car_id,
                'date' => $request->report_date
            ],
            [
                'brand' => $request->brand,
                'number' => $request->number,
                'fuel_type' => $request->fuel_type,
                'driver' => $request->driver,
                'fuel_rate_summer' => $request->fuel_rate_summer,
                'fuel_rate_winter' => $request->fuel_rate_winter,
                'distance' => $request->distance,
                'counted_distance' => $request->counted_distance,
                'distance_remainder' => $request->distance_remainder
            ]);
    }

    public function validateRoute(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'route' => 'required',
            'distance' => 'required|integer'
        ]);

        return response()->json($request);
    }
}
