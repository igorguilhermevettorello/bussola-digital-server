<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class AlunoTest extends TestCase
{

    public function testShouldCreateAlunoJoao(){

        $parameters = [
            'nome' => 'Joáo',
            'sexo' => 'M',
            'nascimento' => '1990-01-01'
        ];

        $this->post("/api/aluno", $parameters, []);
        $this->seeStatusCode(201);
        $this->seeJsonStructure(
            [
                'id',
                'nome',
                'sexo',
                'nascimento'
            ]
        );
    }

    public function testShouldCreateAlunoMaria(){

        $parameters = [
            'nome' => 'Maria',
            'sexo' => 'F',
            'nascimento' => '1990-01-01'
        ];

        $this->post("/api/aluno", $parameters, []);
        $this->seeStatusCode(201);
        $this->seeJsonStructure(
            [
                'id',
                'nome',
                'sexo',
                'nascimento'
            ]
        );
    }

    public function testShouldGetAlunoString(){
        $this->get("/api/aluno/a1");
        $this->seeStatusCode(404);
    }

    public function testShouldGetAlunoInt(){
        $this->get("/api/aluno/1");
        $this->seeStatusCode(200);
    }

    public function testShouldGetAllAlunos(){
        $response = $this->call('GET', '/api/aluno');
        $this->assertEquals(
            2, count(json_decode($response->content()))
        );
    }

}
