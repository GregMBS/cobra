<?php

namespace App\Console\Commands;

use App\ReferenceClass;
use Illuminate\Console\Command;

class LoadRefs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:referencias';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Build or rebuild Referencias table from Debtor';

    /** @var ReferenceClass */
    protected $rc;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->rc = new ReferenceClass();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->rc->load();
        return 'Referencias cargadas';
    }
}
