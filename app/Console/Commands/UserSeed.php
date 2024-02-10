<?php

namespace App\Console\Commands;

use Database\Seeders\User;
use Illuminate\Console\Command;

class UserSeed extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'user:seed {user} {company}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Seed for specific user';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $class = $this->laravel->make(User::class);

        $class->setContainer($this->laravel)->setCommand($this)->__invoke();
    }
}
