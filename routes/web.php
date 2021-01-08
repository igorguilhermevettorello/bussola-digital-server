<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get("/", function () use ($router) {
    return $router->app->version();
});

$router->group(["prefix" => "api"], function() use ($router) {
    $router->get("/", "AlunoController@index");
    $router->post("aluno", "AlunoController@store");
    $router->get("aluno", "AlunoController@getAll");
    $router->get("aluno/{id}", "AlunoController@getById");
    $router->put("aluno/{id}", "AlunoController@update");
    $router->delete("aluno/{id}", "AlunoController@destroy");

    $router->post("turma", "TurmaController@store");
    $router->get("turma", "TurmaController@getAll");
    $router->get("turma/{id}", "TurmaController@getById");
    $router->put("turma/{id}", "TurmaController@update");
    $router->delete("turma/{id}", "TurmaController@destroy");

    $router->post("matricula", "MatriculaController@store");
    $router->get("matricula", "MatriculaController@show");

});

