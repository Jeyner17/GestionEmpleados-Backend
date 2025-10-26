<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Provincia;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class ProvinciaController extends Controller
{

    public function index(): JsonResponse
    {
        try {
            $provincias = Provincia::select('id', 'nombre_provincia', 'capital_provincia')
                ->orderBy('nombre_provincia', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $provincias,
                'message' => 'Provincias obtenidas exitosamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener provincias',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function show(int $id): JsonResponse
    {
        try {
            $provincia = Provincia::findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $provincia,
                'message' => 'Provincia encontrada'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Provincia no encontrada'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener provincia',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}