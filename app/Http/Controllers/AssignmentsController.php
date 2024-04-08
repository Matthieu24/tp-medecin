<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AssignmentService;
use Exception;

class AssignmentsController extends Controller
{

    protected $assignmentService;

    public function __construct(AssignmentService $assignmentService)
    {
        $this->assignmentService = $assignmentService;
    }

    public function index(Request $request)
    {
        try {
            $filters = $request->all();
            $assignments = $this->assignmentService->getAllAssignments($filters);
            return response()->json($assignments);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function store(Request $request)
    {
        if (
            !$request->input('doctor_id')
            || !$request->input("patient_id"
                || !$request->input("room_id")
                || !$request->input('date')
                || !$request->input('end_date'))
        ) {
            return response()->json(['error' => 'Un paramètre est manquant'], 400);
        }
        $newAssignment = (object) [
            'doctor' => $request->input('doctor_id'),
            'patient' => $request->input('patient_id'),
            'room' => $request->input('room_id'),
            'date' => $request->input('date'),
            'end_date' => $request->input('end_date')
        ];

        try {
            $assignments = $this->assignmentService->addAssignment($newAssignment);
            return response()->json($assignments);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function show($id)
    {
        try {
            $assignments = $this->assignmentService->getOneAssignment($id);
            return response()->json($assignments);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function update(Request $request, $id)
    {
        if (
            !$request->input('doctor_id')
            || !$request->input("patient_id"
                || !$request->input("room_id")
                || !$request->input('date')
                || !$request->input('end_date'))
        ) {
            return response()->json(['error' => 'Un paramètre est manquant'], 400);
        }
        $updatedAssignment = (object) [
            'doctor' => $request->input('doctor_id'),
            'patient' => $request->input('patient_id'),
            'room' => $request->input('room_id'),
            'date' => $request->input('date'),
            'end_date' => $request->input('end_date')
        ];

        try {
            $assignments = $this->assignmentService->updateAssignment($updatedAssignment, $id);
            return response()->json($assignments);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $assignments = $this->assignmentService->destroyAssignment($id);
            return response()->json($assignments);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }
}