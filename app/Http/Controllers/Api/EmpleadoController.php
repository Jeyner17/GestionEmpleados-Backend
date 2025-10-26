<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class EmpleadoController extends Controller
{

    public function index(Request $request): JsonResponse
    {
        try {
            $query = Empleado::with(['provinciaResidencia', 'provinciaLaboral']);

            if ($request->has('search') && !empty($request->search)) {
                $query->buscar($request->search);
            }

            if ($request->has('estado') && !empty($request->estado)) {
                $query->where('estado', $request->estado);
            }

            $perPage = $request->get('per_page', 20);
            $empleados = $query->orderBy('created_at', 'desc')->paginate($perPage);

            return response()->json([
                'success' => true,
                'data' => $empleados,
                'message' => 'Empleados obtenidos exitosamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener empleados',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function store(Request $request): JsonResponse
    {
        try {
            $validator = Validator::make($request->all(), [
                'nombres' => 'required|string|max:100',
                'apellidos' => 'required|string|max:100',
                'cedula' => 'required|string|max:20|unique:empleados,cedula',
                'provincia_id' => 'nullable|exists:provincias,id',
                'fecha_nacimiento' => 'required|date|before:today',
                'email' => 'required|email|max:150|unique:empleados,email',
                'observaciones_personales' => 'nullable|string',
                'fotografia' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                
                'fecha_ingreso' => 'required|date',
                'cargo' => 'required|string|max:100',
                'departamento' => 'required|string|max:100',
                'provincia_laboral_id' => 'nullable|exists:provincias,id',
                'sueldo' => 'required|numeric|min:0',
                'jornada_parcial' => 'required|boolean',
                'observaciones_laborales' => 'nullable|string',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $request->all();
            $data['codigo_empleado'] = Empleado::generarCodigoEmpleado();
            $data['estado'] = 'VIGENTE';

            if ($request->hasFile('fotografia')) {
                $path = $request->file('fotografia')->store('empleados', 'public');
                $data['fotografia'] = $path;
            }

            $empleado = Empleado::create($data);
            $empleado->load(['provinciaResidencia', 'provinciaLaboral']);

            return response()->json([
                'success' => true,
                'data' => $empleado,
                'message' => 'Empleado creado exitosamente'
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al crear empleado',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $empleado = Empleado::with(['provinciaResidencia', 'provinciaLaboral'])
                ->findOrFail($id);

            return response()->json([
                'success' => true,
                'data' => $empleado,
                'message' => 'Empleado encontrado'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Empleado no encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al obtener empleado',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $empleado = Empleado::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'nombres' => 'required|string|max:100',
                'apellidos' => 'required|string|max:100',
                'cedula' => 'required|string|max:20|unique:empleados,cedula,' . $id,
                'provincia_id' => 'nullable|exists:provincias,id',
                'fecha_nacimiento' => 'required|date|before:today',
                'email' => 'required|email|max:150|unique:empleados,email,' . $id,
                'observaciones_personales' => 'nullable|string',
                'fotografia' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                
                'fecha_ingreso' => 'required|date',
                'cargo' => 'required|string|max:100',
                'departamento' => 'required|string|max:100',
                'provincia_laboral_id' => 'nullable|exists:provincias,id',
                'sueldo' => 'required|numeric|min:0',
                'jornada_parcial' => 'required|boolean',
                'observaciones_laborales' => 'nullable|string',
                'estado' => 'required|in:VIGENTE,RETIRADO',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error de validación',
                    'errors' => $validator->errors()
                ], 422);
            }

            $data = $request->except(['codigo_empleado']); 

            if ($request->hasFile('fotografia')) {
                if ($empleado->fotografia) {
                    Storage::disk('public')->delete($empleado->fotografia);
                }
                
                $path = $request->file('fotografia')->store('empleados', 'public');
                $data['fotografia'] = $path;
            }

            $empleado->update($data);
            $empleado->load(['provinciaResidencia', 'provinciaLaboral']);

            return response()->json([
                'success' => true,
                'data' => $empleado,
                'message' => 'Empleado actualizado exitosamente'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Empleado no encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al actualizar empleado',
                'error' => $e->getMessage()
            ], 500);
        }
    }


    public function destroy(int $id): JsonResponse
    {
        try {
            $empleado = Empleado::findOrFail($id);

            if ($empleado->fotografia) {
                Storage::disk('public')->delete($empleado->fotografia);
            }

            $empleado->delete();

            return response()->json([
                'success' => true,
                'message' => 'Empleado eliminado exitosamente'
            ], 200);

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Empleado no encontrado'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al eliminar empleado',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function reporte(): JsonResponse
    {
        try {
            $empleados = Empleado::with(['provinciaResidencia', 'provinciaLaboral'])
                ->orderBy('nombres', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $empleados,
                'total' => $empleados->count(),
                'message' => 'Reporte generado exitosamente'
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al generar reporte',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}