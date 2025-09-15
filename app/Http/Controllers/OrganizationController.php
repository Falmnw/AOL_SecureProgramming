<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;

class OrganizationController extends Controller
{
    public function viewAllOrganization(){
        $organizations = Organization::all();
        return view('---', compact('organizations'));
    }
}
