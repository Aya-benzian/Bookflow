<?php

namespace App\Console\Commands;

use App\Models\Emprunt;
use App\Notifications\OverdueBookNotification;
use Illuminate\Console\Command;
use Carbon\Carbon;

class SendOverdueReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reminders:overdue';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email reminders for overdue books.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $overdueEmprunts = Emprunt::with(['user', 'livre'])
            ->where('date_retour_prevue', '<', Carbon::today())
            ->get();

        if ($overdueEmprunts->isEmpty()) {
            $this->info('No overdue books found today.');
            return Command::SUCCESS;
        }

        foreach ($overdueEmprunts as $emprunt) {
            $emprunt->user->notify(new OverdueBookNotification($emprunt));
            $this->info("Sent overdue reminder for book '{$emprunt->livre->titre}' to user '{$emprunt->user->email}'.");
        }

        $this->info('Overdue reminders sent successfully!');

        return Command::SUCCESS;
    }
}
