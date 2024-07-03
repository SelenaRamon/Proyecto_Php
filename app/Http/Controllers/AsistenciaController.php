<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;
use App\Models\Docente;
use App\Models\Grupo;
use App\Models\Estudiante;

class AsistenciaController extends Controller
{
    public function index(Request $request)
    {
        $query = Asistencia::query();

        // Filtrar por docente_id si se proporciona
        if ($request->has('docente_id') && is_numeric($request->docente_id)) {
            $query->where('docente_id', '=', $request->docente_id);
        }

        $asistencias = $query->with('docente', 'grupo')
                            ->orderBy('id', 'desc')
                            ->simplePaginate(5);

        $docentes = Docente::all();
        $grupos = Grupo::all();

        return view('asistencias.index', compact('asistencias', 'docentes', 'grupos'));
    }

    public function create()
    {
        $docentes = Docente::all();
        $grupos = Grupo::all();
        $estudiantes = Estudiante::all();
        return view('asistencias.create', compact('docentes', 'grupos', 'estudiantes'));
    }

    public function store(Request $request)
    {
        // Crear nueva instancia de Asistencia
        $asistencia = new Asistencia();
        $asistencia->grupo_id = $request->grupo_id;
        $asistencia->estudiante_id = $request->estudiante_id;
        $asistencia->fecha = $request->fecha;
        $asistencia->hora_entrada = $request->hora_entrada;
        $asistencia->save();

        return redirect()->route('asistencias.index')->with('success', 'Asistencia creada correctamente');
    }

    public function show($id)
    {
        $asistencia = Asistencia::find($id);

        if (!$asistencia) {
            return abort(404);
        }
        return view('asistencias.show', compact('asistencia'));
    }

    public function edit($id)
    {
        $asistencia = Asistencia::find($id);

        if (!$asistencia) {
            return abort(404);
        }

        $docentes = Docente::all();
        $grupos = Grupo::all();
        $estudiantes = Estudiante::all();

        return view('asistencias.edit', compact('asistencia', 'docentes', 'grupos', 'estudiantes'));
    }

    public function update(Request $request, $id)
    {
        $asistencia = Asistencia::find($id);

        if (!$asistencia) {
            return abort(404);
        }

        // Actualizar los campos de la asistencia
        $asistencia->grupo_id = $request->grupo_id;
        $asistencia->estudiante_id = $request->estudiante_id;
        $asistencia->fecha = $request->fecha;
        $asistencia->hora_entrada = $request->hora_entrada;
        $asistencia->save();

        return redirect()->route('asistencias.index')->with('success', 'Asistencia actualizada correctamente.');
    }

    public function delete($id)
    {
        $asistencia = Asistencia::find($id);

        if (!$asistencia) {
            return abort(404);
        }

        return view('asistencias.delete', compact('asistencia'));
    }

    public function destroy($id)
    {
        $asistencia = Asistencia::find($id);
        if (!$asistencia) {
            return abort(404);
        }

        $asistencia->delete();

        return redirect()->route('asistencias.index')->with('success', 'Asistencia eliminada correctamente.');
    }
}
