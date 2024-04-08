<?php

namespace App\Services;

use App\Models\Patients;
use Illuminate\Http\Request;
use Exception;

class PatientService
{
    public function getAllPatients($filters)
    {
        try {
            if ($filters) {
                $query = Patients::query();

                foreach ($filters as $key => $value) {
                    if (in_array($key, ['name', 'age', 'gender', 'diagnostic', 'coordinate', 'address', 'phone'])) {
                        $query->where($key, 'like', '%' . $value . '%');
                    }
                }
                $patients = $query->get();
            } else {
                $patients = Patients::all();
            }
            return response()->json($patients);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function addPatient($newPatient)
    {
        try {
            $patient = new Patients;
            $patient->name = $newPatient->name;
            $patient->age = $newPatient->age;
            $patient->gender = $newPatient->gender;
            $patient->diagnostic = $newPatient->diagnostic;
            $patient->coordinate = $newPatient->coordinate;
            $patient->address = $newPatient->address;
            $patient->phone = $newPatient->phone;
            $patient->save();
            return response()->json($patient, 201);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function getOnePatient($id)
    {
        try {
            $patient = Patients::findOrFail($id);
            return response()->json($patient);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function updatePatient($updatedPatient, $id)
    {
        try {
            $patient = Patients::findOrFail($id);
            $patient->name = $updatedPatient->name;
            $patient->age = $updatedPatient->age;
            $patient->gender = $updatedPatient->gender;
            $patient->diagnostic = $updatedPatient->diagnostic;
            $patient->coordinate = $updatedPatient->coordinate;
            $patient->address = $updatedPatient->address;
            $patient->phone = $updatedPatient->phone;
            $patient->save();
            return response()->json($patient, 200);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function destroyPatient($id)
    {
        try {
            $patient = Patients::findOrFail($id);
            $patient->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }
}