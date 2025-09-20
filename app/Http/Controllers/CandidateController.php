<?php

namespace App\Http\Controllers;

use App\Models\buat_sesi;
use App\Models\Candidate;
use App\Models\Organization;
use App\Models\OrganizationUser;
use App\Models\Vote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CandidateController extends Controller
{
    private function getAuthorizedOrganization($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $roleName = OrganizationUser::where('organization_id', $id)->first()->getRoleUser();
        if ($roleName !== 'Admin') {
            abort(403, 'Unauthorized access');
        } 
        return true;
    }
    public function createSession($id){
        $this->getAuthorizedOrganization($id);
        $organization = Organization::findOrFail($id);
        return view('organization.create-session', compact('organization'));
    }
    public function storeSession(Request $request,$id){
        $this->getAuthorizedOrganization($id);
        // $request->validate([
        //     'title' => 'required|string',
        //     'start_time' => 'required|date|after_or_equal:now',
        //     'end_time' => 'required|date|after:start_time',
        // ]);

        buat_sesi::create([
            'title' => $request->title,
            'organization_id' => $id,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()->route('organization.create-session', $id)->with('success', 'Voting berhasil dibuat!');

    }
    public function deleteSession($id){
        $this->getAuthorizedOrganization($id);
        $sesi =buat_sesi::where('organization_id', $id)->first();
        $candidate =Candidate::where('organization_id', $id);
        $vote =Vote::where('organization_id', $id);
        $sesi->delete();
        $candidate->delete();
        $vote->delete();
         return redirect()->route('organization.show', ['id' => $id])->with('success', 'Delete Berhasil');
    }
    public function showSession($id){
        $sesi = buat_sesi::where('organization_id', $id)->first();
        $organization = Organization::with('candidates')->findOrFail($id);
        $user = Auth::user();
        $winner = $organization->candidates()->orderByDesc('total')->first();
        return view('organization.show-session', compact('sesi', 'organization','user', 'winner'));
    }
    public function show($id){
        $this->getAuthorizedOrganization($id);
        $organization = Organization::findOrFail($id);
        return view('organization.store-candidate', compact('organization'));
    }

    public function storeCandidate(Request $request, $id){
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
    public function storeVote(Request $request){
        $user_id = Auth::id();
        $organization_id = $request->input('organization_id');
        $candidate_id = $request->input('candidate_id');

        $exists = Vote::where('user_id', $user_id)->where('organization_id', $organization_id)->exists();
        if ($exists) {
            return redirect()->route('organization.show', ['id' => $organization_id])->with('error', 'Anda sudah vote');
        }

        Vote::create([
            'user_id' => $user_id,
            'organization_id' => $organization_id,
        ]);
        $candidate = Candidate::where('user_id', $candidate_id)->where('organization_id', $organization_id)->first();
        $candidate->total += 1;
        $candidate->save();
        return redirect()->route('organization.show', ['id' => $organization_id])->with('success', 'Berhasil Vote');
    }
}