<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/logs', 'RequestLogController', [
    'only' => [
        'index', 'store', 'show', 'update', 'destroy'
    ],
    'names' => [
        'index' => 'logs.list',
        'show' => 'logs.get',
        'store' => 'logs.store',
        'update' => 'logs.update',
        'destroy' => 'logs.delete',
    ]
]);
