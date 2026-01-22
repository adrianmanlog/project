<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Repuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class RepuestoController extends Controller
{
    public function index(Request $request)
    {
        $consulta = Repuesto::query();

        if ($request->has('tipo')) {
            $consulta->where('tipo', $request->tipo);
        }

        $repuestos = $consulta->paginate(15);
        return response()->json($repuestos);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|in:ballesta,amortiguador,otro',
            'marca' => 'required|string|max:255',
            'referencia' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'descripcion' => 'nullable|string',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'exito' => false,
                'errores' => $validador->errors()
            ], 422);
        }

        $repuesto = Repuesto::create($request->all());

        return response()->json([
            'exito' => true,
            'mensaje' => 'Repuesto creado exitosamente',
            'datos' => $repuesto
        ], 201);
    }

    public function show(string $id)
    {
        $repuesto = Repuesto::find($id);

        if (!$repuesto) {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Repuesto no encontrado'
            ], 404);
        }

        return response()->json([
            'exito' => true,
            'datos' => $repuesto
        ]);
    }

    public function update(Request $request, string $id)
    {
        $repuesto = Repuesto::find($id);

        if (!$repuesto) {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Repuesto no encontrado'
            ], 404);
        }

        $validador = Validator::make($request->all(), [
            'nombre' => 'sometimes|required|string|max:255',
            'tipo' => 'sometimes|required|in:ballesta,amortiguador,otro',
            'marca' => 'sometimes|required|string|max:255',
            'referencia' => 'sometimes|required|string|max:255',
            'precio' => 'sometimes|required|numeric|min:0',
            'stock' => 'sometimes|required|integer|min:0',
            'descripcion' => 'nullable|string',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'exito' => false,
                'errores' => $validador->errors()
            ], 422);
        }

        $repuesto->update($request->all());

        return response()->json([
            'exito' => true,
            'mensaje' => 'Repuesto actualizado exitosamente',
            'datos' => $repuesto
        ]);
    }

    public function destroy(string $id)
    {
        $repuesto = Repuesto::find($id);

        if (!$repuesto) {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Repuesto no encontrado'
            ], 404);
        }

        $repuesto->delete();

        return response()->json([
            'exito' => true,
            'mensaje' => 'Repuesto eliminado exitosamente'
        ]);
    }

    public function actualizarStock(Request $request, string $id)
    {
        $repuesto = Repuesto::find($id);

        if (!$repuesto) {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Repuesto no encontrado'
            ], 404);
        }

        $validador = Validator::make($request->all(), [
            'stock' => 'required|integer|min:0',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'exito' => false,
                'errores' => $validador->errors()
            ], 422);
        }

        $repuesto->update(['stock' => $request->stock]);

        return response()->json([
            'exito' => true,
            'mensaje' => 'Stock actualizado exitosamente',
            'datos' => $repuesto
        ]);
    }
}
