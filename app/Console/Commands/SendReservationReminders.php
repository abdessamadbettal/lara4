<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationReminderEmail;

class SendReservationReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-reservation-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders for reservations happening in less than 24 hours';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $now = Carbon::now();
        $reminderTime = $now->copy()->addDay();

        $reservations = Reservation::where('reminded_at', null)
            ->whereBetween('start_date', [$now, $reminderTime])
            ->get();


        foreach ($reservations as $reservation) {
            Mail::to($reservation->customer->email)->send(new ReservationReminderEmail($reservation));
            $reservation->reminded_at = $now;
            $reservation->save();
        }

        $this->info('Reservation reminders sent successfully.');
    }
}
