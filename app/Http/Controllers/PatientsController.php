<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PatientService;
use Exception;

class PatientsController extends Controller
{

    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function index(Request $request)
    {

        try {
            $filters = $request->all();
            $patients = $this->patientService->getAllPatients($filters);
            return response()->json($patients);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function store(Request $request)
    {
        if (
            !$request->input('name')
            || !$request->input("age")
            || !$request->input("gender")
            || !$request->input("diagnostic")
            || !$request->input("coordinate")
            || !$request->input("address")
            || !$request->input('phone')
        ) {
            return response()->json(['error' => 'Un paramètre est manquant'], 400);
        }
        $newPatient = (object) [
            'name' => $request->input('name'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
            'diagnostic' => $request->input('diagnostic'),
            'coordinate' => $request->input('coordinate'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone')
        ];

        try {
            $patients = $this->patientService->addPatient($newPatient);
            return response()->json($patients);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function show($id)
    {
        try {
            $patients = $this->patientService->getOnePatient($id);
            return response()->json($patients);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function update(Request $request, $id)
    {
        if (
            !$request->input('name')
            || !$request->input("age")
            || !$request->input("gender")
            || !$request->input("diagnostic")
            || !$request->input("coordinate")
            || !$request->input("address")
            || !$request->input('phone')
        ) {
            return response()->json(['error' => 'Un paramètre est manquant'], 400);
        }
        $updatedPatient = (object) [
            'name' => $request->input('name'),
            'age' => $request->input('age'),
            'gender' => $request->input('gender'),
            'diagnostic' => $request->input('diagnostic'),
            'coordinate' => $request->input('coordinate'),
            'address' => $request->input('address'),
            'phone' => $request->input('phone')
        ];

        try {
            $patients = $this->patientService->updatePatient($updatedPatient, $id);
            return response()->json($patients);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $patients = $this->patientService->destroyPatient($id);
            return response()->json($patients);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }
}