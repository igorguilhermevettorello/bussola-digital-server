<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AlunoController extends Controller
{

    public function index() {
        return "sistema online";
    }

    public function store(Request $request)
    {
        $error = [];

        try {
            $aluno = [
                "nome"       => trim($request->nome),
                "sexo"       => trim(strtoupper($request->sexo)),
                "nascimento" => $request->nascimento
            ];

            $error = $this->beforeSave($aluno);

            if (empty($error)) {
                return response()->json(Aluno::create($aluno), 201);
            } else {
                return response()->json($error, 401);
            }
        } catch (Throwable $e) {
            array_push($error, [
                "campo" => "nome",
                "descricao" => $e->getMessage()
            ]);

            return response()->json($error, 401);
        }
    }

    public function getById(string $id)
    {
        if ($this->isInteger($id)) {
            $id = intval($id);
            $aluno = Aluno::find($id);
            if (!is_null($aluno)) {
                return response()->json($aluno, 200);

            } else {
                return response()->json(null, 404);
            }
        } else {
            return response()->json(null, 404);
        }
    }

    public function getAll()
    {
        return Aluno::all();
    }

    public function update(string $id, Request $request)
    {
        $error = [];
        if ($this->isInteger($id)) {
            $id = intval($id);
            $aluno = Aluno::find($id);
            if (!is_null($aluno)) {
                $aux = [
                    "nome"       => isset($request->nome)       ? trim($request->nome)             : $aluno["nome"],
                    "sexo"       => isset($request->sexo)       ? trim(strtoupper($request->sexo)) : $aluno["sexo"],
                    "nascimento" => isset($request->nascimento) ? $request->nascimento             : $aluno["nascimento"]
                ];

                $error = $this->beforeSave($aux);

                if (empty($error)) {
                    $aluno->update($aux);
                    return response()->json($aluno, 201);
                }
            }
        }

        return response()->json($error, 401);
    }

    public function destroy(string $id, Request $request)
    {
        $error = [];
        if ($this->isInteger($id)) {
            $aluno = Aluno::destroy($id);
            return response()->json(null, 204);
        }

        return response()->json($error, 401);
    }


}
