<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class TurmaTest extends TestCase
{
    public function testShouldCreateTurmaIngles(){

        $parameters = [
            'nome' => 'Curso de Inglês'
        ];

        $this->post("/api/turma", $parameters, []);
        $this->seeStatusCode(201);
        $this->seeJsonStructure(
            [
                'id',
                'nome'
            ]
        );
    }

    public function testShouldCreateTurmaInformatica(){

        $parameters = [
            'nome' => 'Curso de Informática'
        ];

        $this->post("/api/turma", $parameters, []);
        $this->seeStatusCode(201);
        $this->seeJsonStructure(
            [
                'id',
                'nome'
            ]
        );
    }

    public function testShouldCreateTurmaInformaticaNovamente(){

        $parameters = [
            'nome' => 'Curso de Informática'
        ];

        $this->post("/api/turma", $parameters, []);
        $this->seeStatusCode(401);
    }

    public function testShouldGetTurmaString(){
        $this->get("/api/turma/a1");
        $this->seeStatusCode(404);
    }

    public function testShouldGetTurmaInt(){
        $this->get("/api/turma/1");
        $this->seeStatusCode(200);
    }

    public function testShouldGetAllTurmas(){
        $response = $this->call('GET', '/api/turma');
        $this->assertEquals(
            2, count(json_decode($response->content()))
        );
    }

    public function testShouldCreateMatriculaValida(){

        $parameters = [
            'aluno_id' => 1,
            'turma_id' => 1,
        ];

        $this->post("/api/matricula", $parameters, []);
        $this->seeStatusCode(201);
    }

    public function testShouldCreateMatriculaInvalida(){

        $parameters = [
            'aluno_id' => 999,
            'turma_id' => 999,
        ];

        $this->post("/api/matricula", $parameters, []);
        $this->seeStatusCode(401);
    }


    public function testShouldCreateMatricuLista(){

        $response = $this->call('GET', '/api/matricula');
        $this->assertEquals(
            1, count(json_decode($response->content()))
        );
    }
}
