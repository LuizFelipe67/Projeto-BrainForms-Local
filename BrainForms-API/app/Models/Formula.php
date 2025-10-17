<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formula extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'tipo', 
        'descricao', 
        'expressao'
    ];

    public function historicos()
    {
        return $this->hasMany(HistoricoFormula::class);
    }
}
