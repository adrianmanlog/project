<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reparacion;
use App\Models\Repuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReparacionController extends Controller
{
    public function index(Request $request)
    {
        $consulta = Reparacion::with(['camion', 'servicio', 'repuestos']);

        if ($request->has('estado')) {
            $consulta->where('estado', $request->estado);
        }

        $reparaciones = $consulta->orderBy('created_at', 'desc')->paginate(15);
        return response()->json($reparaciones);
    }

    public function store(Request $request)
    {
        $validador = Validator::make($request->all(), [
            'camion_id' => 'required|exists:camiones,id',
            'servicio_id' => 'required|exists:servicios,id',
            'estado' => 'sometimes|in:pendiente,en_progreso,completada,cancelada',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'costo_total' => 'sometimes|numeric|min:0',
            'notas' => 'nullable|string',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'exito' => false,
                'errores' => $validador->errors()
            ], 422);
        }

        $reparacion = Reparacion::create($request->all());
        $reparacion->load(['camion', 'servicio', 'repuestos']);

        return response()->json([
            'exito' => true,
            'mensaje' => 'Reparación creada exitosamente',
            'datos' => $reparacion
        ], 201);
    }

    public function show(string $id)
    {
        $reparacion = Reparacion::with(['camion', 'servicio', 'repuestos'])->find($id);

        if (!$reparacion) {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Reparación no encontrada'
            ], 404);
        }

        return response()->json([
            'exito' => true,
            'datos' => $reparacion
        ]);
    }

    public function update(Request $request, string $id)
    {
        $reparacion = Reparacion::find($id);

        if (!$reparacion) {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Reparación no encontrada'
            ], 404);
        }

        $validador = Validator::make($request->all(), [
            'camion_id' => 'sometimes|required|exists:camiones,id',
            'servicio_id' => 'sometimes|required|exists:servicios,id',
            'estado' => 'sometimes|in:pendiente,en_progreso,completada,cancelada',
            'fecha_inicio' => 'sometimes|required|date',
            'fecha_fin' => 'nullable|date|after_or_equal:fecha_inicio',
            'costo_total' => 'sometimes|numeric|min:0',
            'notas' => 'nullable|string',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'exito' => false,
                'errores' => $validador->errors()
            ], 422);
        }

        $reparacion->update($request->all());
        $reparacion->load(['camion', 'servicio', 'repuestos']);

        return response()->json([
            'exito' => true,
            'mensaje' => 'Reparación actualizada exitosamente',
            'datos' => $reparacion
        ]);
    }

    public function destroy(string $id)
    {
        $reparacion = Reparacion::find($id);

        if (!$reparacion) {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Reparación no encontrada'
            ], 404);
        }

        $reparacion->delete();

        return response()->json([
            'exito' => true,
            'mensaje' => 'Reparación eliminada exitosamente'
        ]);
    }

    public function agregarRepuestos(Request $request, string $id)
    {
        $reparacion = Reparacion::find($id);

        if (!$reparacion) {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Reparación no encontrada'
            ], 404);
        }

        $validador = Validator::make($request->all(), [
            'repuestos' => 'required|array',
            'repuestos.*.repuesto_id' => 'required|exists:repuestos,id',
            'repuestos.*.cantidad' => 'required|integer|min:1',
            'repuestos.*.precio_unitario' => 'required|numeric|min:0',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'exito' => false,
                'errores' => $validador->errors()
            ], 422);
        }

        foreach ($request->repuestos as $datosRepuesto) {
            $reparacion->repuestos()->attach($datosRepuesto['repuesto_id'], [
                'cantidad' => $datosRepuesto['cantidad'],
                'precio_unitario' => $datosRepuesto['precio_unitario'],
            ]);

            $repuesto = Repuesto::find($datosRepuesto['repuesto_id']);
            if ($repuesto) {
                $repuesto->stock -= $datosRepuesto['cantidad'];
                $repuesto->save();
            }
        }

        $reparacion->load('repuestos');

        return response()->json([
            'exito' => true,
            'mensaje' => 'Repuestos agregados exitosamente',
            'datos' => $reparacion
        ]);
    }

    public function actualizarEstado(Request $request, string $id)
    {
        $reparacion = Reparacion::find($id);

        if (!$reparacion) {
            return response()->json([
                'exito' => false,
                'mensaje' => 'Reparación no encontrada'
            ], 404);
        }

        $validador = Validator::make($request->all(), [
            'estado' => 'required|in:pendiente,en_progreso,completada,cancelada',
        ]);

        if ($validador->fails()) {
            return response()->json([
                'exito' => false,
                'errores' => $validador->errors()
            ], 422);
        }

        $reparacion->update(['estado' => $request->estado]);

        return response()->json([
            'exito' => true,
            'mensaje' => 'Estado actualizado exitosamente',
            'datos' => $reparacion
        ]);
    }
}
