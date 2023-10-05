<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Reservation;

class CheckRepeatUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:check-repeat';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update repeat users';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Repeat user check started.');

    // Get all users
    $users = User::all();

    foreach ($users as $user) {
        $userId = $user->id;

        // Count reservations for the user
        $reservationsCount = Reservation::where('user_id', $userId)->count();

        // Determine if the user is a repeat user
        $isRepeatUser = $reservationsCount > 4 ? 'yes' : 'no';

        // Update the repeat_user column
        $user->repeat_user = $isRepeatUser;
        $user->save();

        // Output the user's ID, reservations count, and repeat status
        $this->info("User ID: $userId, Reservations Count: $reservationsCount, Repeat User: $isRepeatUser");
    }

    $this->info('Repeat user check completed.');
    
       
    }
}
