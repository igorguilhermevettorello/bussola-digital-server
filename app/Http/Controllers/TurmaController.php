<?php

namespace App\Http\Controllers;

use App\Models\Turma;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TurmaController extends Controller
{

    public function store(Request $request)
    {
        $error = [];

        try {
            $turma = [
                "nome" => trim($request->nome)
            ];

            $error = $this->beforeSaveTurma($turma);

            if (empty($error)) {
                return response()->json(Turma::create($turma), 201);
            } else {
                return response()->json($error, 401);
            }
        } catch (\Throwable $e) {
            $error = $this->getMessageError($e->getMessage());
            return response()->json($error, 401);
        }
    }

    public function getById(string $id)
    {
        if ($this->isInteger($id)) {
            $id = intval($id);
            $turma = Turma::find($id);
            if (!is_null($turma)) {
                return response()->json($turma, 200);

            } else {
                return response()->json(null, 404);
            }
        } else {
            return response()->json(null, 404);
        }
    }

    public function getAll()
    {
        return Turma::all();
    }

    public function update(string $id, Request $request)
    {
        $error = [];

        try {
            if ($this->isInteger($id)) {
                $id = intval($id);
                $turma = Turma::find($id);
                if (!is_null($turma)) {
                    $aux = [
                        "nome" => isset($request->nome) ? trim($request->nome) : $turma["nome"],
                    ];

                    $error = $this->beforeSaveTurma($aux);

                    if (empty($error)) {
                        $turma->update($aux);
                        return response()->json($turma, 201);
                    }
                }
            }
        } catch (\Throwable $e) {
            $error = $this->getMessageError($e->getMessage());
        }

        return response()->json($error, 401);
    }

    public function destroy(string $id, Request $request)
    {
        $error = [];
        if ($this->isInteger($id)) {
            $aluno = Turma::destroy($id);
            return response()->json(null, 204);
        }

        return response()->json($error, 401);
    }


}
