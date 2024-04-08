<?php

namespace App\Services;

use App\Models\Assignments;
use Illuminate\Http\Request;
use Exception;

class AssignmentService
{
    public function getAllAssignments($filters)
    {
        try {
            if ($filters) {
                $query = Assignments::query();

                foreach ($filters as $key => $value) {
                    if (in_array($key, ['doctor_id', 'patient_id', 'room_id', 'date', 'end_date'])) {
                        $query->where($key, 'like', '%' . $value . '%');
                    }
                }
                $assignments = $query->get();
            } else {
                $assignments = Assignments::all();
            }
            return response()->json($assignments);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function addAssignment($newAssignment)
    {
        try {
            $assignment = new Assignments;
            $assignment->doctor_id = $newAssignment->doctor;
            $assignment->patient_id = $newAssignment->patient;
            $assignment->room_id = $newAssignment->room;
            $assignment->date = $newAssignment->date;
            $assignment->end_date = $newAssignment->end_date;
            $assignment->save();
            return response()->json($assignment, 201);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function getOneAssignment($id)
    {
        try {
            $assignment = Assignments::findOrFail($id);
            return response()->json($assignment);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function updateAssignment($updatedAssignment, $id)
    {
        try {
            $assignment = Assignments::findOrFail($id);
            $assignment->doctor_id = $updatedAssignment->doctor;
            $assignment->patient_id = $updatedAssignment->patient;
            $assignment->room_id = $updatedAssignment->room;
            $assignment->date = $updatedAssignment->date;
            $assignment->end_date = $updatedAssignment->end_date;
            $assignment->save();
            return response()->json($assignment, 200);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function destroyAssignment($id)
    {
        try {
            $assignment = Assignments::findOrFail($id);
            $assignment->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }
}