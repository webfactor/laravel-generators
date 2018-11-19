<?php

namespace Webfactor\Laravel\Generators\Commands;

use Webfactor\Laravel\Generators\Contracts\CommandAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;
use Webfactor\Laravel\Generators\Schemas\Schema;
use Webfactor\Laravel\Generators\Services\AddToGitService;
use Webfactor\Laravel\Generators\Services\OpenIdeService;

class MakeEntity extends CommandAbstract
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:entity {entity} {--schema=name:string} {--migrate} {--git} {--ide=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make Entity';

    /**
     * The Schema object.
     *
     * @var Schema
     */
    public $schema;

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
        $this->info('Loading Schema');
        $this->schema = new Schema($this->option('schema'));
    }

    private function loadNaming()
    {
        $this->info('Loading Naming Classes');

        $namingClasses = config('webfactor.generators.naming');
        $count = count($namingClasses);
        $counter = 0;

        foreach ($namingClasses as $key => $naming) {
            $this->info(++$counter . '/' . $count . ' Naming Class: ' . $naming, 'v');

            $namingObject = new $naming($this->entity);
            $this->naming[$key] = $namingObject;
        }

        $this->line('');
    }

    private function loadServices()
    {
        $services = $this->getServicesToBeExecuted();
        $progressBar = $this->output->createProgressBar(count($services));

        foreach ($services as $k => $serviceClass) {
            $serviceInstance = new $serviceClass($this);
            $this->executeService($serviceInstance);

            $progressBar->advance();
            $this->info(' '.$serviceInstance->getConsoleOutput());
        }

        $this->line('');
    }

    private function getServicesToBeExecuted(): array
    {
        $serviceClassesToBeExecuted = config('webfactor.generators.services', []);
        array_push($serviceClassesToBeExecuted, OpenIdeService::class);
        array_push($serviceClassesToBeExecuted, AddToGitService::class);

        return $serviceClassesToBeExecuted;
    }

    private function executeService(ServiceInterface $service)
    {
        $service->call();
    }

}
