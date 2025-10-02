<?php

namespace App\Console\Commands;
use App\Mail\WinnerAnnouncement;
use Illuminate\Console\Command;
use App\Models\Candidate;
use App\Models\Organization;
use App\Models\Vote;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\MailNotify;
use Illuminate\Support\Facades\DB;

class SendWinnerAnnouncement extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-winner-announcement';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending email to all voters';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $organization = Organization::first();
        $winnerVote = DB::table('candidates')
                            ->join('users','candidates.user_id','=','users.id')
                            ->select('users.name','candidates.total')
                            ->where('candidates.organization_id',$organization->id)
                            ->orderByDesc('candidates.total')
                            ->first();

        $winnerCandidate = $winnerVote->name;
        $winnerTotal = $winnerVote->total;

        $users = User::with('organizations')->get();

        foreach ($users as $user){
            Mail::  to($user->email)->send(new WinnerAnnouncement($winnerCandidate,$organization,$winnerTotal));
            $this->info("Email queued for: {$user->email}");
        }

        $this->info('Pengumuman pemenang sudah dikirim ke semua anggota.');
        return Command::SUCCESS;
    }
}
