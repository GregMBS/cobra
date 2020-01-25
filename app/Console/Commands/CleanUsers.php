<?php

namespace App\Console\Commands;

use DB;
use Illuminate\Console\Command;
use PDO;

class CleanUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'clean:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'remove anti-COBRA elements from users table';

    /** @var PDO */
    protected $pdo;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->pdo = DB::getPdo();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $query = "ALTER TABLE `cobra`.`users` 
DROP INDEX `users_email_unique`";
        $this->pdo->query($query);
        return 'UNIQUE index on email removed';
    }
}
