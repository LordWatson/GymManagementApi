<?php

namespace App\Console\Commands;

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
        $personalTrainersArray = User::whereHas(
            'roles', function($q){
            $q->where('name', 'Personal Trainer');
        }
        )->pluck('id')
            ->toArray();
        dd(count($personalTrainersArray) - 1);
    }
}
