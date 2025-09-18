<?php

namespace App\Http\Controllers;

use App\Models\AllowedMember;
use App\Models\Candidate;
use App\Models\Organization;
use App\Models\OrganizationUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class OrganizationController extends Controller
{
    private function getAuthorizedOrganization($id, $with = [])
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $exists = $user->organizations()->where('organization_id', $id)->exists();
        if (!$exists) {
            abort(403, 'Unauthorized access to this organization');
        }
        return Organization::with($with)->findOrFail($id);
    }

    public function store(Request $request){
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $isAllowed = AllowedMember::where('email', $user->email)->where('organization_id', $request->organization_id)->exists();
        if (!$isAllowed) {
            return redirect('/')->with('error', 'Email Anda tidak diizinkan untuk bergabung ke organisasi ini.');
        }
        $user->organizations()->syncWithoutDetaching([$request->organization_id]);

        return redirect('/')->with('success', 'Berhasil bergabung ke organisasi!');
    }

    public function list(){
        $organizations = Organization::all();
        return view('organization.list', compact('organizations'));
    }

    public function show($id)
    {
        $organization = $this->getAuthorizedOrganization($id);
        return view('organization.show', compact('organization'));
    }

    public function candidate($id)
    {
        $organization = $this->getAuthorizedOrganization($id, ['candidates']);
        $user = Auth::user();
        return view('organization.candidate', compact('organization', 'user'));
    }

    public function member($id)
    {
        $organization = $this->getAuthorizedOrganization($id);
        return view('organization.member', compact('organization'));
    }
    public function giveRole($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $exists = $user->organizations()->where('organization_id', $id)->where('role_id', 2)->exists();
        if (!$exists) {
            abort(403, 'Unauthorized access');
        }
        $organization = Organization::findOrFail($id);
        return view('organization.give-role', compact('organization'));
    }
    public function storeRole(Request $request, $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $request->validate([
            'role_id' => 'required|exists:roles,id',
        ]);

        $organization = $user
            ->organizations()
            ->where('organizations.id', $id)
            ->first();

        if (! $organization || $organization->pivot->role_id > 2) {
            abort(403, 'Unauthorized access');
        }
        $user_id = $request->input('user_id');
        $organization_id = $request->input('organization_id');
        $role_id = $request->input('role_id');

        OrganizationUser::where('user_id', $user_id)
                        ->where('organization_id', $organization_id)
                        ->update(['role_id' => $role_id]);
        if ($role_id == 6) { 
            Candidate::firstOrCreate(
                [
                    'user_id' => $user_id,
                    'organization_id' => $organization_id,
                ],
                [
                    'total' => 0,
                ]
            );
        }

        return view('organization.give-role', compact('organization'));
    }
}
