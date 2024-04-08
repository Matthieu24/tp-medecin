<?php

namespace App\Services;

use App\Models\Doctors;
use Illuminate\Http\Request;
use Exception;

class DoctorService
{
    public function getAllDoctors($filters)
    {
        try {
            if ($filters) {
                $query = Doctors::query();

                foreach ($filters as $key => $value) {
                    if (in_array($key, ['name', 'speciality', 'coordinate', 'phone'])) {
                        $query->where($key, 'like', '%' . $value . '%');
                    }
                }
                $doctors = $query->get();
            } else {
                $doctors = Doctors::all();
            }
            return response()->json($doctors);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function addDoctor($newDoctor)
    {
        try {
            $doctor = new Doctors;
            $doctor->name = $newDoctor->name;
            $doctor->speciality = $newDoctor->speciality;
            $doctor->coordinate = $newDoctor->coordinate;
            $doctor->phone = $newDoctor->phone;
            $doctor->save();
            return response()->json($doctor, 201);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function getOneDoctor($id)
    {
        try {
            $doctor = Doctors::findOrFail($id);
            return response()->json($doctor);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function updateDoctor($updatedDoctor, $id)
    {
        try {
            $doctor = Doctors::findOrFail($id);
            $doctor->name = $updatedDoctor->name;
            $doctor->speciality = $updatedDoctor->speciality;
            $doctor->coordinate = $updatedDoctor->coordinate;
            $doctor->phone = $updatedDoctor->phone;
            $doctor->save();
            return response()->json($doctor, 200);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function destroyDoctor($id)
    {
        try {
            $doctor = Doctors::findOrFail($id);
            $doctor->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }
}