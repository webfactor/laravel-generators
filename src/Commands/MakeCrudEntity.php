<?php

namespace Webfactor\Laravel\Generators\Commands;

use Illuminate\Console\Command;

class MakeCrudEntity extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {entity}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Make full Backpack CRUD Entity';

    protected $entity;
    protected $entities;
    protected $entitiesSnakeCase;

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
        $this->handleArguments();

        $this->makeMigration();
        $this->makeFactory();
        $this->makeSeeder();
        $this->makeCrud();

    }

    private function handleArguments(): void
    {
        $this->entity = $this->argument('entity');
        $this->entities = str_plural($this->entity);
        $this->entitiesSnakeCase = snake_case($this->entities);

    }

    private function makeMigration(): void
    {
        $this->call('make:migration:schema', [
            'name' => 'create_' . $this->entitiesSnakeCase . '_table',
            '--model' => 0,
            '--schema' => 'name:string'
        ]);
    }

    private function makeFactory(): void
    {
        $this->call('make:factory', [
            'name' => $this->entity . 'Factory'
        ]);
    }

    private function makeSeeder(): void
    {
        $this->call('make:seeder', [
            'name' => $this->entities . 'TableSeeder'
        ]);
    }

    private function makeCrud(): void
    {
        $this->call('backpack:crud', [
            'name' => $this->entity
        ]);
    }

}
