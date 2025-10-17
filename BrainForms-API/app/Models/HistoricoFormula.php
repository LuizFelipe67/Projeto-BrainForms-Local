<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoricoFormula extends Model
{
    use HasFactory;

    protected $fillable = [
        'aluno_id', 
        'formula_id', 
        'valores', 
        'resultado', 
        'data_uso'
    ];

    protected $casts = [
        'valores' => 'array',
        'resultado' => 'array',
    ];

    public function aluno()
    {
        return $this->belongsTo(Aluno::class);
    }

    public function formula()
    {
        return $this->belongsTo(Formula::class);
    }
}
