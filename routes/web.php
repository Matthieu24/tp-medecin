<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('doctors', 'DoctorsController');
Route::resource('patients', 'PatientsController');
Route::resource('illnesses', 'IllnessesController');
Route::resource('rooms', 'RoomsController');
Route::resource('assignments', 'AssignmentsController');