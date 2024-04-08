<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\IllnessesService;
use Exception;

class IllnessesController extends Controller
{

    protected $illnessesService;

    public function __construct(IllnessesService $illnessesService)
    {
        $this->illnessesService = $illnessesService;
    }

    public function index(Request $request)
    {

        try {
            $filters = $request->all();
            $illnessess = $this->illnessesService->getAllIllnesses($filters);
            return response()->json($illnessess);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function store(Request $request)
    {
        if (
            !$request->input('name')
            || !$request->input("category")
            || !$request->input("gravity")
        ) {
            return response()->json(['error' => 'Un paramètre est manquant'], 400);
        }
        $newIllnesses = (object) [
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'gravity' => $request->input('gravity')
        ];

        try {
            $illnessess = $this->illnessesService->addIllnesses($newIllnesses);
            return response()->json($illnessess);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function show($id)
    {
        try {
            $illnessess = $this->illnessesService->getOneIllnesses($id);
            return response()->json($illnessess);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function update(Request $request, $id)
    {
        if (
            !$request->input('name')
            || !$request->input("category")
            || !$request->input("gravity")
        ) {
            return response()->json(['error' => 'Un paramètre est manquant'], 400);
        }
        $updatedIllnesses = (object) [
            'name' => $request->input('name'),
            'category' => $request->input('category'),
            'gravity' => $request->input('gravity')
        ];

        try {
            $illnessess = $this->illnessesService->updateIllnesses($updatedIllnesses, $id);
            return response()->json($illnessess);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $illnessess = $this->illnessesService->destroyIllnesses($id);
            return response()->json($illnessess);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }
}