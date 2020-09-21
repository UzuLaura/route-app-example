<?php

namespace App\Http\Controllers;

use App\Car;
use App\School;
use Illuminate\Http\Request;

class GenerationController extends Controller
{
    /**
     * @var int given total distance
     */
    private $distance;
    /**
     * @var string date of report (last day of month)
     */
    private $date;
    /**
     * @var array of generated routes with extra data
     */
    private $routes;
    /**
     * @var int total calculated distance after route generation
     */
    private $counted_distance = 0;

    /**
     * Return randomly generated routes with information about given data for request.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function generateRoutes(Request $request)
    {
        $this->date = $request->date;

        $this->validationRules($request);
        $this->setRoutes($request->distance);

        return response()->json([
            'routes' => $this->routes,
            'car' => Car::where('id', $request->car)->first(),
            'date' => $request->date,
            'distance' => $request->distance,
            'counted_distance' => $this->counted_distance,
            'distance_remainder' => ($request->distance - $this->counted_distance),
        ]);
    }

    /**
     * Validate request for generation.
     *
     * @param Request $request
     * @return array
     */
    private function validationRules(Request $request): array
    {
        return $request->validate([
            'car' => 'required',
            'distance' => 'required|integer',
            'date' => 'required|date',
        ]);
    }

    /**
     * Add randomly generated routes data to routes list.
     */
    private function setRoutesData()
    {
        School::inRandomOrder()->chunk(100, function ($schools) {
            foreach ($schools as $school) {

                if ($this->distance >= $school->distance) {
                    $this->routes[] = [
                        'date' => DateController::getRandomDayInMonth($this->date),
                        'route' => env('BASE_ADDRESS') . ' - ' . $school->address . ' - ' . env('BASE_ADDRESS'),
                        'distance' => $school->distance,
                    ];

                    $this->counted_distance += $school->distance;
                    $this->distance -= ($school->distance);
                }

            }
        });
    }

    /**
     * Add random routes to routes list until required distance
     * or loops limit is reached.
     *
     * @param int $distance
     */
    private function setRoutes(int $distance)
    {
        $loop_limit = 4;
        $this->distance = $distance;

        while ($this->distance > 0) {

            // Stop cycle if cycle limit is reached to prevent endless cycle
            if ($loop_limit == 0) {
                break;
            }

            $this->setRoutesData();
            $loop_limit--;
        }
    }
}
