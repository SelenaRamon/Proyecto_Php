@extends('layouts.app')

@section('content')
    @if (session('success'))
        <div class="alert alert-success fade show" id="success-message" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <h1>Lista de asistencias</h1>

    <form action="{{ route('asistencias.index') }}" method="GET">
        @csrf
        <div class="row">
            <div class="col-sm-4">
                <label for="grupo_id" class="form-label">Grupo</label>
                <select name="grupo_id" class="form-control">
                    <option value="">Seleccione un grupo</option>
                    @foreach ($grupos as $grupo)
                        <option value="{{ $grupo->id }}">{{ $grupo->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-4">
                <button type="submit" class="btn btn-primary">Buscar</button>
                <a href="{{ route('asistencias.create') }}" class="btn btn-secondary">Crear nueva</a>
            </div>
        </div>
    </form>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Grupo</th>
                <th>Estudiante</th>
                <th>Fecha</th>
                <th>Hora de Entrada</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($asistencias as $asistencia)
                <tr>
                    <td>{{ optional($asistencia->grupo)->nombre }}</td>
                    <td>{{ optional($asistencia->estudiante)->nombre }} {{ optional($asistencia->estudiante)->apellido }}</td>
                    <td>{{ $asistencia->fecha }}</td>
                    <td>{{ $asistencia->hora_entrada }}</td>
                    <td>
                        <a href="{{ route('asistencias.edit', $asistencia->id) }}" class="btn btn-warning">Editar</a>
                        <a href="{{ route('asistencias.show', $asistencia->id) }}" class="btn btn-info">Ver</a>
                        <a href="{{ route('asistencias.delete', $asistencia->id) }}" class="btn btn-danger">Eliminar</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
        
    </table>
    <div class="row">
        <div class="col-sm-12">
            {{ $asistencias->links() }}
        </div>
    </div>
@endsection
