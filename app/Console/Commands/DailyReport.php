<?php

namespace App\Console\Commands;

use App\Mail\DailyReportMail;
use App\Models\Data;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class DailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:daily-report';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        // total pengajuan hari ini
        $total = DB::table('data')
            ->whereDate('created_at', $today)
            ->count();

        $admin = User::role('admin')->get();
        // kirim email
        Mail::to($admin)->send(
            new DailyReportMail($total)
        );

        $this->info('Daily report email sent!');
    }
}
