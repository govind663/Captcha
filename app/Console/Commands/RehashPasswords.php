<?php

namespace App\Console\Commands;

use App\Models\Citizen;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class RehashPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:rehash-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rehash user passwords';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Fetch all Citizen
        $citizens = Citizen::all();

        foreach ($citizens as $citizen) {
            // Check if the password needs rehashing
            if (Hash::needsRehash($citizen->backup_password)) {
                // Rehash the password
                $citizen->backup_password = Hash::make($citizen->backup_password);
                $citizen->save();

                $this->info("Password for citizen {$citizen->id} has been rehashed.");
            } else {
                $this->info("Password for citizen {$citizen->id} does not need rehashing.");
            }
        }

        $this->info('All citizen passwords have been rehashed.');
    }
}
