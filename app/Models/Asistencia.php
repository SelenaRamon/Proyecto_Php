<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;

    protected $table = 'asistencia'; // Nombre de la tabla en la base de datos en singular

    protected $fillable = [
        'grupo_id',
        'estudiante_id',
        'fecha',
        'hora_entrada'
    ];

    public function grupo()
    {
        return $this->belongsTo(Grupo::class, 'grupo_id');
    }

    public function estudiante()
    {
        return $this->belongsTo(Estudiante::class, 'estudiante_id');
    }

    public function docente()
{
    return $this->belongsTo(Docente::class, 'docente_id');
}

    
}
