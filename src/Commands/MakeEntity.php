<?php

namespace Webfactor\Laravel\Generators\Commands;

use Illuminate\Console\Command;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;
use Webfactor\Laravel\Generators\Schemas\Schema;
use Webfactor\Laravel\Generators\Services\OpenIdeService;

class MakeEntity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:entity {entity} {--schema=name:string} {--migrate} {--ide=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Entity';

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
     * The Schema object.
     *
     * @var Schema
     */
    public $schema;

    /**
     * The naming schema object.
     *
     * @var array
     */
    public $naming = [];

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->entity = $this->argument('entity');

        $this->loadSchema();
        $this->loadNaming();
        $this->loadServices();
    }

    private function loadSchema()
    {
        $this->schema = new Schema($this->option('schema'));
    }

    private function loadNaming()
    {
        foreach (config('webfactor.generators.naming') as $key => $naming) {
            $namingObject = new $naming($this->entity);
            $this->naming[$key] = $namingObject;
        }
    }

    private function loadServices()
    {
        $services = $this->getServicesToBeExecuted();
        $progressBar = $this->output->createProgressBar(count($services));

        foreach ($services as $serviceClass) {
            $this->executeService(new $serviceClass($this));

            $progressBar->advance();
        }

        $progressBar->finish();
    }

    private function getServicesToBeExecuted(): array
    {
        $serviceClassesToBeExecuted = config('webfactor.generators.services', []);
        array_push($serviceClassesToBeExecuted, OpenIdeService::class);

        return $serviceClassesToBeExecuted;
    }

    private function executeService(ServiceInterface $service)
    {
        $service->call();
    }

    /**
     * Adds file to $filesToBeOpened stack.
     *
     * @param $file
     * @return void
     */
    public function addFile(?\SplFileInfo $file): void
    {
        if ($file) {
            array_push($this->filesToBeOpened, $file);
        }
    }
}
