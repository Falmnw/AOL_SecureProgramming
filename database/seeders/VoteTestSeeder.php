<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Organization;
use App\Models\Role;
use App\Models\Candidate;
use App\Models\Vote;

class VoteTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $orgKeren = Organization::firstOrCreate(['name'=>'KLUB KEREN','member'=>'77']);
        $usersKeren = User::factory()->count(10)->create();
        $roleKeren = Role::firstOrCreate(['name' => 'member']);

        foreach ($usersKeren as $user){
            $user->organizations()->attach($orgKeren->id,['role_id'=>$roleKeren->id]);
        }

        $candidate1 = Candidate::create([
            'user_id'=>$usersKeren[0]->id,
            'organization_id'=>$orgKeren->id,
            'total'=>0,
        ]);
         $candidate2 = Candidate::create([
            'user_id'=>$usersKeren[1]->id,
            'organization_id'=>$orgKeren->id,
            'total'=>0,
         ]);
         Vote::create(['user_id'=>$usersKeren[2]->id,'organization_id'=>$orgKeren->id]);
         Vote::create(['user_id'=>$usersKeren[3]->id,'organization_id'=>$orgKeren->id]);
         Vote::create(['user_id'=>$usersKeren[4]->id,'organization_id'=>$orgKeren->id]);

         $candidate1->total = 2;
         $candidate1->save();
         $candidate2->total = 1;
         $candidate2->save();
    }
}
