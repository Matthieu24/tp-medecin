<?php

namespace App\Services;

use App\Models\Illnesses;
use Illuminate\Http\Request;
use Exception;

class IllnessesService
{
    public function getAllIllnesses($filters)
    {
        try {
            if ($filters) {
                $query = Illnesses::query();

                foreach ($filters as $key => $value) {
                    if (in_array($key, ['name', 'category', 'gravity'])) {
                        $query->where($key, 'like', '%' . $value . '%');
                    }
                }
                $illnessess = $query->get();
            } else {
                $illnessess = Illnesses::all();
            }
            return response()->json($illnessess);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function addIllnesses($newIllnesses)
    {
        try {
            $illnesses = new Illnesses;
            $illnesses->name = $newIllnesses->name;
            $illnesses->category = $newIllnesses->category;
            $illnesses->coordinate = $newIllnesses->gravity;
            $illnesses->save();
            return response()->json($illnesses, 201);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function getOneIllnesses($id)
    {
        try {
            $illnesses = Illnesses::findOrFail($id);
            return response()->json($illnesses);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function updateIllnesses($updatedIllnesses, $id)
    {
        try {
            $illnesses = Illnesses::findOrFail($id);
            $illnesses->name = $updatedIllnesses->name;
            $illnesses->category = $updatedIllnesses->category;
            $illnesses->coordinate = $updatedIllnesses->coordinate;
            $illnesses->save();
            return response()->json($illnesses, 200);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function destroyIllnesses($id)
    {
        try {
            $illnesses = Illnesses::findOrFail($id);
            $illnesses->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }
}