<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Camion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CamionController extends Controller
{
    public function index()
    {
        $camiones = Camion::with('reparaciones')->paginate(15);
        return response()->json($camiones);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'matricula' => 'required|string|unique:camiones,matricula',
            'marca' => 'required|string|max:255',
            'modelo' => 'required|string|max:255',
            'año' => 'required|integer|min:1900|max:' . (date('Y') + 1),
            'nombre_propietario' => 'required|string|max:255',
            'telefono_propietario' => 'required|string|max:255',
            'email_propietario' => 'nullable|email|max:255',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'exito' => false,
                'errores' => $validador->errors()
            ], 422);
        }

        $camion = Camion::create($request->all());

        return response()->json([
            'exito' => true,
            'mensaje' => 'Camión creado exitosamente',
            'datos' => $camion
        ], 201);
    }

    public function show(string $id)
    {
        $camion = Camion::with(['reparaciones.servicio', 'reparaciones.repuestos'])->find($id);

        if (!$camion) {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Camión no encontrado'
            ], 404);
        }

        return response()->json([
            'exito' => true,
            'datos' => $camion
        ]);
    }

    public function update(Request $request, string $id)
    {
        $camion = Camion::find($id);

        if (!$camion) {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Camión no encontrado'
            ], 404);
        }

        $validador = Validator::make($request->all(), [
            'matricula' => 'sometimes|required|string|unique:camiones,matricula,' . $id,
            'marca' => 'sometimes|required|string|max:255',
            'modelo' => 'sometimes|required|string|max:255',
            'año' => 'sometimes|required|integer|min:1900|max:' . (date('Y') + 1),
            'nombre_propietario' => 'sometimes|required|string|max:255',
            'telefono_propietario' => 'sometimes|required|string|max:255',
            'email_propietario' => 'nullable|email|max:255',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'exito' => false,
                'errores' => $validador->errors()
            ], 422);
        }

        $camion->update($request->all());

        return response()->json([
            'exito' => true,
            'mensaje' => 'Camión actualizado exitosamente',
            'datos' => $camion
        ]);
    }

    public function destroy(string $id)
    {
        $camion = Camion::find($id);

        if (!$camion) {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Camión no encontrado'
            ], 404);
        }

        $camion->delete();

        return response()->json([
            'exito' => true,
            'mensaje' => 'Camión eliminado exitosamente'
        ]);
    }
}
