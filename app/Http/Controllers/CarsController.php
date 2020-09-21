<?php

namespace App\Http\Controllers;

use App\Car;
use Illuminate\Http\Request;

class CarsController extends Controller
{
    /**
     * Get all cars.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCars()
    {
        return response()->json(Car::all());
    }

    /**
     * Get car data by id.
     *
     * @param int $id of car
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCar(int $id)
    {
        return response()->json(Car::where('id', $id)->first());
    }

    /**
     * Update car info in DB by car id.
     *
     * @param Request $request
     * @param int $id of car
     * @return mixed
     */
    private function updateCar(Request $request, int $id)
    {
        return Car::where('id', $id)->update([
            'brand' => $request->brand,
            'number' => $request->number,
            'fuel_type' => $request->fuel_type,
            'driver' => $request->driver,
            'fuel_rate_summer' => $request->fuel_rate_summer,
            'fuel_rate_winter' => $request->fuel_rate_winter,
        ]);
    }

    /**
     * Edit car data by id.
     *
     * @param Request $request
     * @param int $id of car
     * @return \Illuminate\Http\JsonResponse
     */
    public function editCar(Request $request, int $id)
    {
        $this->validateRequest($request);
        $this->updateCar($request, $id);

        return $this->getCars();
    }

    /**
     * Validation rules for updating or adding a car.
     *
     * @param Request $request
     * @return array
     */
    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'brand' => 'required',
            'number' => 'required',
            'fuel_type' => 'required',
            'driver' => 'required',
            'fuel_rate_summer' => 'required|regex:/^\d+(\.\d{1,2})?$/',
            'fuel_rate_winter' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);
    }

}
