<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\RoomService;
use Exception;

class RoomsController extends Controller
{

    protected $roomService;

    public function __construct(RoomService $roomService)
    {
        $this->roomService = $roomService;
    }

    public function index(Request $request)
    {

        try {
            $filters = $request->all();
            $rooms = $this->roomService->getAllRooms($filters);
            return response()->json($rooms);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function store(Request $request)
    {
        if (
            !$request->input('number')
            || !$request->input("type")
            || !$request->input("status")
        ) {
            return response()->json(['error' => 'Un paramètre est manquant'], 400);
        }
        $newRoom = (object) [
            'number' => $request->input('number'),
            'type' => $request->input('type'),
            'status' => $request->input('status'),
        ];

        try {
            $rooms = $this->roomService->addRoom($newRoom);
            return response()->json($rooms);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function show($id)
    {
        try {
            $rooms = $this->roomService->getOneRoom($id);
            return response()->json($rooms);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function update(Request $request, $id)
    {
        if (
            !$request->input('number')
            || !$request->input("type")
            || !$request->input("status")
        ) {
            return response()->json(['error' => 'Un paramètre est manquant'], 400);
        }
        $updatedRoom = (object) [
            'number' => $request->input('number'),
            'type' => $request->input('type'),
            'status' => $request->input('status'),
        ];

        try {
            $rooms = $this->roomService->updateRoom($updatedRoom, $id);
            return response()->json($rooms);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }

    public function destroy($id)
    {
        try {
            $rooms = $this->roomService->destroyRoom($id);
            return response()->json($rooms);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 400);
        }
    }
}