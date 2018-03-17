<?php

namespace Webfactor\Laravel\Generators\Commands;

use Illuminate\Console\Command;
use Webfactor\Laravel\Generators\MakeServices;

class MakeEntity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:entity {entity} {--schema=}';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Entity';
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
     *
     * @return mixed
     */
    public function handle()
    {
        (new MakeServices($this))->call();
    }
}
