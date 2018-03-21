<?php

namespace Webfactor\Laravel\Generators\Services;

use Webfactor\Laravel\Generators\Contracts\ServiceAbstract;
use Webfactor\Laravel\Generators\Contracts\ServiceInterface;

class BackpackCrudRequestService extends ServiceAbstract implements ServiceInterface
{
    protected $relativeToBasePath = 'app/Http/Requests/Admin';

    public function call()
    {
        $this->command->call('make:crud-request', [
            'name' => $this->getName($this->command->entity),
        ]);

        $this->addLatestFileToIdeStack();
    }

    public function getName(string $entity): string
    {
        return ucfirst($entity);
    }
}
