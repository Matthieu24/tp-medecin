<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\DoctorService;
use Exception;

class DoctorsController extends Controller
{

    protected $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    public function index(Request $request)
    {

        try {
            $filters = $request->all();
            $doctors = $this->doctorService->getAllDoctors($filters);
            return response()->json($doctors);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function store(Request $request)
    {
        if (
            !$request->input('name')
            || !$request->input("speciality")
            || !$request->input("coordinate")
            || !$request->input('phone')
        ) {
            return response()->json(['error' => 'Un paramètre est manquant'], 400);
        }
        $newDoctor = (object) [
            'name' => $request->input('name'),
            'speciality' => $request->input('speciality'),
            'coordinate' => $request->input('coordinate'),
            'phone' => $request->input('phone')
        ];

        try {
            $doctors = $this->doctorService->addDoctor($newDoctor);
            return response()->json($doctors);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function show($id)
    {
        try {
            $doctors = $this->doctorService->getOneDoctor($id);
            return response()->json($doctors);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function update(Request $request, $id)
    {
        if (
            !$request->input('name')
            || !$request->input("speciality")
            || !$request->input("coordinate")
            || !$request->input('phone')
        ) {
            return response()->json(['error' => 'Un paramètre est manquant'], 400);
        }
        $updatedDoctor = (object) [
            'name' => $request->input('name'),
            'speciality' => $request->input('speciality'),
            'coordinate' => $request->input('coordinate'),
            'phone' => $request->input('phone')
        ];

        try {
            $doctors = $this->doctorService->updateDoctor($updatedDoctor, $id);
            return response()->json($doctors);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $doctors = $this->doctorService->destroyDoctor($id);
            return response()->json($doctors);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }
}