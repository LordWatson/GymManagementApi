<?php

namespace App\Console\Commands;

use App\Models\GymClassAttendee;
use App\Models\User;
use Illuminate\Console\Command;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $users = User::all();

        foreach($users as $user)
        {
            // Get the row you don't want to delete.
            $dontDeleteThisRow = GymClassAttendee::where('user_id', $user->id)->first();
            if(isset($dontDeleteThisRow))
            {
                // Delete all rows except the one we fetched above.
                GymClassAttendee::where('user_id', $user->id)->where('id', '!=', $dontDeleteThisRow->id)->delete();
            }
        }
    }
}
