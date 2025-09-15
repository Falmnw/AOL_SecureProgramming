<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/organizations',[OrganizationController::class,'viewAllOrganization']);
Route::get('/organizations/{$organization_id}/candidates',[CandidateController::class,'viewByOrganization']);
