<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Servicio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ServicioController extends Controller
{
    public function index(Request $request)
    {
        $consulta = Servicio::query();

        if (!$request->has('mostrar_todos')) {
            $consulta->activo();
        }

        $servicios = $consulta->paginate(15);
        return response()->json($servicios);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_base' => 'required|numeric|min:0',
            'horas_estimadas' => 'required|numeric|min:0',
            'activo' => 'sometimes|boolean',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'exito' => false,
                'errores' => $validador->errors()
            ], 422);
        }

        $servicio = Servicio::create($request->all());

        return response()->json([
            'exito' => true,
            'mensaje' => 'Servicio creado exitosamente',
            'datos' => $servicio
        ], 201);
    }

    public function show(string $id)
    {
        $servicio = Servicio::with('reparaciones')->find($id);

        if (!$servicio) {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Servicio no encontrado'
            ], 404);
        }

        return response()->json([
            'exito' => true,
            'datos' => $servicio
        ]);
    }

    public function update(Request $request, string $id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Servicio no encontrado'
            ], 404);
        }

        $validador = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio_base' => 'sometimes|required|numeric|min:0',
            'horas_estimadas' => 'sometimes|required|numeric|min:0',
            'activo' => 'sometimes|boolean',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'exito' => false,
                'errores' => $validador->errors()
            ], 422);
        }

        $servicio->update($request->all());

        return response()->json([
            'exito' => true,
            'mensaje' => 'Servicio actualizado exitosamente',
            'datos' => $servicio
        ]);
    }

    public function destroy(string $id)
    {
        $servicio = Servicio::find($id);

        if (!$servicio) {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Servicio no encontrado'
            ], 404);
        }

        $servicio->delete();

        return response()->json([
            'exito' => true,
            'mensaje' => 'Servicio eliminado exitosamente'
        ]);
    }
}
