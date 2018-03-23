<?php

namespace Webfactor\Laravel\Generators\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Finder\SplFileInfo;
use Webfactor\Laravel\Generators\MakeServices;
use Webfactor\Laravel\Generators\Schemas\MigrationSchema;

class MakeEntity extends Command
{
    /**
     * Paths to files which should automatically be opened in IDE if the
     * option --ide is set (and IDE capable).
     *
     * @var array
     */
    public $filesToBeOpened = [];

    /**
     * The name of the entity being created.
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
    protected $signature = 'make:entity {entity} {--schema="name:string"} {--migrate} {--ide=}';

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

    /**
     * Adds file to $filesToBeOpened stack.
     *
     * @param $file
     * @return void
     */
    public function addFile(SplFileInfo $file): void
    {
        array_push($this->filesToBeOpened, $file);
    }
}
