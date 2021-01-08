<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateUnique extends Migration
{
    public function up()
    {
        DB::statement('
            ALTER TABLE turmas ADD CONSTRAINT uc_turmas_nome UNIQUE (`nome`);
        ');
    }

    public function down()
    {
        DB::statement('
            ALTER TABLE turmas DROP INDEX `uc_turmas_nome`;
        ');
    }
}
