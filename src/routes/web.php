<?php

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

$router->get('/', function () use ($router) {
    return "hello, this is the root";
});

$router->get('/campaign/{cid}/affiliate/{aid}', function ($cid, $aid) use ($router) {
    return view('window', ['cid' => $cid, 'aid' => $aid]);
});
