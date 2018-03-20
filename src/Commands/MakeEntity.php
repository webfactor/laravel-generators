<?php

namespace Webfactor\Laravel\Generators\Commands;

use Illuminate\Console\Command;
use Webfactor\Laravel\Generators\MakeServices;
use Webfactor\Laravel\Generators\MigrationSchema;

class MakeEntity extends Command
{
    /**
     * The name of the entity beeing created.
     *
     * @var string
     */
    public $entity;

    /**
     * The migration schema object.
     *
     * @var MigrationSchema
     */
    public $schema;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:entity {entity} {--schema="name:string"} {--migrate}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Entity';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->entity = $this->argument('entity');
        $this->schema = new MigrationSchema($this->option('schema'));

        (new MakeServices($this))->call();
    }
}
