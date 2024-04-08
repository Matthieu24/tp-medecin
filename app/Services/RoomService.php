<?php

namespace App\Services;

use App\Models\Rooms;
use Illuminate\Http\Request;
use Exception;

class RoomService
{
    public function getAllRooms($filters)
    {
        try {
            if ($filters) {
                $query = Rooms::query();

                foreach ($filters as $key => $value) {
                    if (in_array($key, ['number', 'type', 'status'])) {
                        $query->where($key, 'like', '%' . $value . '%');
                    }
                }
                $rooms = $query->get();
            } else {
                $rooms = Rooms::all();
            }
            return response()->json($rooms);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function addRoom($newRoom)
    {
        try {
            $room = new Rooms;
            $room->number = $newRoom->number;
            $room->type = $newRoom->type;
            $room->status = $newRoom->status;
            $room->save();
            return response()->json($room, 201);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function getOneRoom($id)
    {
        try {
            $room = Rooms::findOrFail($id);
            return response()->json($room);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function updateRoom($updatedRoom, $id)
    {
        try {
            $room = Rooms::findOrFail($id);
            $room->number = $updatedRoom->number;
            $room->type = $updatedRoom->type;
            $room->status = $updatedRoom->status;
            $room->save();
            return response()->json($room, 200);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }

    public function destroyRoom($id)
    {
        try {
            $room = Rooms::findOrFail($id);
            $room->delete();
            return response()->json(null, 204);
        } catch (Exception $e) {
            return response()->json(['error' => `Une erreur est survenue. ` . $e], 500);
        }
    }
}