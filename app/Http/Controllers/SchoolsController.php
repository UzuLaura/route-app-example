<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\School;

class SchoolsController extends Controller
{
    /**
     * Get all schools.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSchools()
    {
        return response()->json(School::all());
    }

    /**
     * Update school info in DB by school id.
     *
     * @param Request $request
     * @param int $id of school
     * @return mixed
     */
    private function updateSchool(Request $request, int $id)
    {
        return School::where('id', $id)->update([
            'title' => $request->title,
            'address' => $request->address,
            'distance' => $request->distance,
        ]);
    }

    /**
     * Edit school info by id.
     *
     * @param Request $request
     * @param int $id of school
     * @return \Illuminate\Http\JsonResponse
     */
    public function editSchool(Request $request, int $id)
    {
        $this->validateRequest($request);
        $this->updateSchool($request, $id);

        return $this->getSchools();
    }

    /**
     * Validation rules.
     *
     * @param Request $request
     * @return array
     */
    private function validateRequest(Request $request): array
    {
        return $request->validate([
            'title' => 'required',
            'address' => 'required',
            'distance' => 'required|integer'
        ]);
    }
}
