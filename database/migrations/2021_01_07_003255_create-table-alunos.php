<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTableAlunos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
            CREATE TABLE alunos (
                id INT AUTO_INCREMENT NOT NULL,
                nome VARCHAR(255) NOT NULL,
                sexo VARCHAR(1) NOT NULL,
                nascimento DATE NOT NULL,
                turma_id INT,
                PRIMARY KEY(id),
                CONSTRAINT aluno_turma_id FOREIGN KEY (turma_id) REFERENCES turmas(id)
            ) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('alunos');
    }
}
