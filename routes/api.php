<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::resource('doctors', 'App\Http\Controllers\DoctorsController', [
    'except' => ['edit', 'create']
]);
Route::resource('patients', 'App\Http\Controllers\PatientsController', [
    'except' => ['edit', 'create']
]);
Route::resource('illnesses', 'App\Http\Controllers\IllnessesController', [
    'except' => ['edit', 'create']
]);
Route::resource('rooms', 'App\Http\Controllers\RoomsController', [
    'except' => ['edit', 'create']
]);
Route::resource('assignments', 'App\Http\Controllers\AssignmentsController', [
    'except' => ['edit', 'create']
]);