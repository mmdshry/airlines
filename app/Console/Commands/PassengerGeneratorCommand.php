<?php

namespace App\Console\Commands;

use Database\Seeders\PassengerSeeder;
use Illuminate\Console\Command;

class PassengerGeneratorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:passenger-generator-command';

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
        $this->call('db:seed', ['--class' => 'PassengerSeeder']);
    }
}
