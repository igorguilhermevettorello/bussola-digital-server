<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'nome', 'sexo', 'nascimento', 'turma_id'
    ];

    public function turma() {
        return $this->hasMany(Turma::class);
    }
}
