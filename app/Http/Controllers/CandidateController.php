<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\Candidate;

class CandidateController extends Controller
{
    public function viewByOrganization($organization_id){
        $candidates = Candidate::where('organization_id',$organization_id)->get();

        return view('---',compact('candidates'));
    }


}
