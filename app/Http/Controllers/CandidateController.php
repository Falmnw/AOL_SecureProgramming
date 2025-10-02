<?php

namespace App\Http\Controllers;

use App\Models\Candidate;
use App\Models\Organization;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    private function getAuthorizedOrganization($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $organization = $user->organizations()->where('organization_id', $id)->first();

        if (!$organization) {
            abort(404, 'Organization not found');
        }
        if ($organization->pivot->role_id) {
            $roleName = $organization->pivot->role->name;

            if ($roleName !== 'Admin') {
                abort(403, 'Unauthorized access');
            }
        } else {
            abort(403, 'Unauthorized access');
        }

        return true;
    }
    public function show($id){
        $this->getAuthorizedOrganization($id);
        $organization = Organization::findOrFail($id);
        return view('organization.store-candidate', compact('organization'));
    }

    public function store(Request $request, $id){
        $this->getAuthorizedOrganization($id);
        $user_id = $request->input('user_id');
        $organization_id = $request->input('organization_id');
        foreach($user_id as $uid){
            Candidate::firstOrCreate(
                [
                    'user_id' => $uid,
                    'organization_id' => $organization_id,
                ],
                [
                    'total' => 0,
                ]
            );
        }
        return redirect('/');
    }
    public function want(){
        $organizations = Organization::all();
        return view('wantcandidate', compact('organizations'));
    }
    public function storeVote(Request $request){
        $user_id = $request->input('user_id');
        $organization_id = $request->input('organization_id');
        $candidate_id = $request->input('candidate_id');

        $exists = Vote::where('user_id', $user_id)->where('organization_id', $organization_id)->exists();
        if ($exists) {
            return redirect()->route('organization.show', ['id' => $organization_id])
                            ->with('error', 'Anda sudah vote');
        }

        
        Vote::create([
            'user_id' => $user_id,
            'organization_id' => $organization_id,
        ]);
        
        
        $candidate = Candidate::where('user_id', $candidate_id)->where('organization_id', $organization_id)->first();
        $candidate->total += 1;
        $candidate->save();
        return redirect('/');
    }
    
    public function winner($organization_id){
            $winner = Candidate::where('organization_id',$organization_id)->orderByDesc('total')->first();
            if(!$winner){
                return redirect()->back()->with('error','No candidates or Votes yet');
            }
            return view('winnerPage',compact('winner'));
        }
}