<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class MatriculaController extends Controller
{

    public function store(Request $request)
    {
        $error = [];
        $aluno = null;
        $turma = null;

        $matricula = [
            "aluno_id" => trim($request->aluno_id),
            "turma_id" => trim($request->turma_id)
        ];

        $error = $this->beforeSaveMatricula($matricula);

        if (empty($error)) {
            $aluno = Aluno::find($matricula["aluno_id"]);
            if (is_null($aluno)) {
                array_push($error, [
                    "campo" => "aluno_id",
                    "descricao" => "Aluno não encontrado"
                ]);
            }

            $turma = Turma::find($matricula["turma_id"]);
            if (is_null($aluno)) {
                array_push($error, [
                    "campo" => "turma_id",
                    "descricao" => "Turma não encontrada"
                ]);
            }
        }

        if (empty($error)) {
            $aux = [
                "turma_id" => $turma["id"]
            ];
            $aluno->update($aux);

            return response()->json(null, 201);
        }

        return response()->json($error, 401);
    }

    public function show()
    {
        $aux = [];
        $alunos = Aluno::whereNotNull('turma_id')->get()->all();
        foreach ($alunos as $aluno) {
            $turma = Turma::find($aluno->turma_id);
            array_push($aux, [
                "aluno" => $aluno->nome,
                "turma" => $turma->nome
            ]);
        }

        return response()->json($aux, 200);
    }
}
