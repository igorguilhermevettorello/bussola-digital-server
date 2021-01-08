<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{

    public $timestamps = false;

    protected $fillable = [
        'nome'
    ];

    public function aluno() {
        return $this->belongsTo(Aluno::class);
    }
}