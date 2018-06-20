<?php

namespace Webfactor\Laravel\Generators\Schemas\Naming;

use Carbon\Carbon;
use Webfactor\Laravel\Generators\Contracts\NamingAbstract;

class Migration extends NamingAbstract
{
    /**
     * Relative path to database
     * @var string
     */
    protected $path = 'migrations';

    protected $fileName;

    /**
     * Migration constructor.
     * @param string $entity
     */
    public function __construct(string $entity)
    {
        parent::__construct($entity);

        $this->setFileName();
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return 'Create' . ucfirst(str_plural($this->entity)) . 'Table';
    }

    /**
     * @return string
     */
    public function getTableName(): string
    {
        return snake_case(str_plural($this->entity));
    }

    /**
     * @return void
     */
    public function setFileName(): void
    {
        $this->fileName = Carbon::now()->format('Y_m_d_His') . '_' . snake_case($this->getClassName()) . '.php';
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return database_path($this->path);
    }

    /**
     * @return string
     */
    public function getStub(): string
    {
        return __DIR__ . '/../../../stubs/migration.stub';
    }
}
