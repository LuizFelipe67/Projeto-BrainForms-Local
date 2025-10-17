<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Aluno extends Model
{
    use HasApiTokens, Notifiable;

    protected $table = 'alunos';

    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function conquistas()
    {
        return $this->belongsToMany(Conquista::class, 'aluno_conquistas')
                    ->withPivot('data_conquista')
                    ->withTimestamps();
    }

}

 
