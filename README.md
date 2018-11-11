# laravel-generators

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Software License][ico-license]](LICENSE.md)
[![StyleCI][ico-style-ci]][link-style-ci]
[![Build Status][ico-travis]][link-travis]
[![Coverage Status][ico-scrutinizer]][link-scrutinizer]
[![Quality Score][ico-code-quality]][link-code-quality]
[![Total Downloads][ico-downloads]][link-downloads]

This is a package developed by us for internal use. It is supposed to help us during development and save plenty of time by automating many steps while creating typical CRUD entities with [Laravel Backpack](https://laravel-backpack.readme.io/docs). You can write your own Services (they have to implement `Webfactor\Laravel\Generators\Contracts\ServiceInterface`) and register them in the `generators.php` config file, or use this package as an inspiration for your own implementation.

## Install

### Via Composer

This package is indended to be used only for development, not for production. Because of that we recommend to use `require-dev`:

``` bash
composer require --dev webfactor/laravel-generators
```

## Usage

``` bash
php artisan make:entity {entity_name} {--schema=} {--migrate} {--ide=} {--git} 
```

- `entity_name`: Recommendation: use *singular* for entity. see "[Naming](#naming)" for more information
- `--schema=`: Here you can provide a [schema-String](#schema)
- `--migrate`: will automatically call `php artisan migrate` after creating the migration file
- `--ide=`: will open all files in your prefered [IDE](#open-files-in-ide)
- `--git`: will add all files to [git](#add-files-to-git)


If you want to add Services, Naming classes, Field Types, or IDE Opener you have to publish the config-file:

``` bash
php artisan vendor:publish --provider="Webfactor\Laravel\Generators\GeneratorsServiceProvider" 
```

## Services

All Services defined in the config file have to implement `Webfactor\Laravel\Generators\Contracts\ServiceInterface` and will then be called in the given order.

### Included Services

Can be removed or extended by publishing config file:

- `MigrationService`
- `FactoryService`
- `SeederService`
- Backpack CRUD:
  - `BackpackCrudModelService` (incl. `$fillable`)
  - `BackpackCrudRequestService` (incl. `rules()`)
  - `BackpackCrudControllerService` (incl. CrudColumns and CrudFields, more coming soon)
  - `SidebarService`
- `LanguageFileService`
- `RouteFileService`

### Always available (activated by option):

- `OpenIdeService`
- `AddToGitService`

## Schema

The intention of this package concerning Laravel Backpack CRUD is to provide an easy way to define standard Field Types with some default options and override them if necessary.

Example:

``` bash
php artisan make:entity blog --schema="title:string,text:summernote" 
```

This will use the `StringType` and `SummernoteType` classes to create (besides all other files):

- Blog.php with `$fillable = ['title', 'text']`
- BlogRequest.php with predefined rules for each field
- BlogCrudController.php with columns and fields for `title` and `text`

If you want to add/overwrite certain options you can use something like this:

``` bash
php artisan make:entity blog --schema="title:string(unique|default:title);rule(required|min:3|max:64),text:summernote;field(label:Content);column(label:Content)" 
```

## Field Types

Currently available Field Types (more coming soon):

- Date
- Number
- String
- Summernote (as a proof of concept)
- Text

The available definitions in the Field Type classes currently are:

```php
public $validationRule; // 'required|min:5'...
  
public $migrationField = [
    'type' => 'string', // any type available for a migration file
    // optional:
    // 'unique' => true
    // 'default' => 'value'
    // 'nullable' => true
    // etc.
];

public $crudColumn = [
    'type' => 'text', // or date, number, any backpack column
    // 'label' => 'Name of label'
    // ... any option
];

public $crudField = [
    'type' => 'text', // or date, number, any backpack field
    // 'label' => 'Name of label'
    // ... prefix, suffix... any option
];
```

## Naming

You can provide your own naming convention classes by registering them in the config file. This classes should extend `Webfactor\Laravel\Generators\Contracts\NamingAbstract` to provide a certain base functionality.

Example for `Webfactor\Laravel\Generators\Schemas\Naming\CrudController`:

```php
<?php

namespace Webfactor\Laravel\Generators\Schemas\Naming;

use Webfactor\Laravel\Generators\Contracts\NamingAbstract;

class CrudController extends NamingAbstract
{
    /**
     * @return string
     */
    public function getNamespace(): string
    {
        return $this->getAppNamespace() . 'Http\\Controllers\\Admin';
    }

    /**
     * @return string
     */
    public function getClassName(): string
    {
        return ucfirst($this->entity) . 'CrudController';
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->getClassName() . '.php';
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return app_path('Http/Controllers/Admin');
    }

    /**
     * @return string
     */
    public function getStub(): string
    {
        return __DIR__ . '/../../../stubs/crud-controller.stub';
    }
}
```

All naming classes defined in the config file will be parsed and saved with their keys to the `$naming`-array of the command. As the entire command is available in each service class, you can access ALL naming conventions everywhere!

For example you need the `Request`-namespace in the CrudController: `$this->command->naming['crudRequest']->getNamespace()`.

Furthermore there is a helper to keep things a bit simpler if you are IN the service class of the coresponding naming class! Just define `$key` and you can access the naming conventions directly through `$this->naming`:

```php
<?php

namespace Webfactor\Laravel\Generators\Services;

class MyService extends ServiceAbstract implements ServiceInterface
{
    protected $key = 'myNaming';

    protected function call()
    {
        echo $this->naming;
        // same to
        echo $this->command->naming['myNaming'];
        // but you can additionally access
        echo $this->command->naming['otherNaming'];
    }
}
``` 

## Add files to git

With `{--git}` option all generated files will be added to git automatically. In your service class you have to add the generated file. You can:

- use `$this->command->addFile(SplileInfo $file)` or
- use `$this->addGeneratedFileToIdeStack()` if you use a naming key or
- use the `Webfactor\Laravel\Generators\Traits\CanGenerateFile` define a naming key and just implement a `buildFileContent()` method

## Open files in IDE

If specified we will automatically open all generated files in the IDE of your choice.  
There are three options to use this feature (applied in tis order):
* `{--ide=}` command option
* __.env__ variable `APP_EDITOR`
* config value `config(app.editor)`

The keys in the `ides`-Array of the config file are possible values for the command option.
Per default we provide:
* `phpstorm`: will open all files with `pstorm` CLI helper of PhpStorm
* `pstorm`: will open all files with `pstorm` CLI helper of PhpStorm
* `sublime`: will open all files with `subl` CLI helper of Sublime
* `subl`: will open all files with `subl` CLI helper of Sublime
* `vscode`: will open all files with `code` CLI helper of VSCode
* `code`: will open all files with `code` CLI helper of VSCode

You can add other IDE-Opener classes. They have to implement `Webfactor\Laravel\Generators\Contracts\OpenInIdeInterface`. 

In your service class you have to add the generated file to a stack (see "Add files to git" section)


## Adaption

Feel free to write your own Services that fit your purposes!

## Change log

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CODE_OF_CONDUCT](CODE_OF_CONDUCT.md) for details.

## Security

If you discover any security related issues, please email thomas.swonke@webfactor.de instead of using the issue tracker.

## Credits

- [Thomas Swonke][link-author]
- [All Contributors][link-contributors]

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/webfactor/laravel-generators.svg?style=flat-square
[ico-license]: https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square
[ico-style-ci]: https://styleci.io/repos/125574603/shield
[ico-travis]: https://img.shields.io/travis/webfactor/laravel-generators/master.svg?style=flat-square
[ico-scrutinizer]: https://img.shields.io/scrutinizer/coverage/g/webfactor/laravel-generators.svg?style=flat-square
[ico-code-quality]: https://img.shields.io/scrutinizer/g/webfactor/laravel-generators.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/webfactor/laravel-generators.svg?style=flat-square

[link-packagist]: https://packagist.org/packages/webfactor/laravel-generators
[link-style-ci]: https://styleci.io/repos/125574603
[link-travis]: https://travis-ci.org/webfactor/laravel-generators
[link-scrutinizer]: https://scrutinizer-ci.com/g/webfactor/laravel-generators/code-structure
[link-code-quality]: https://scrutinizer-ci.com/g/webfactor/laravel-generators
[link-downloads]: https://packagist.org/packages/webfactor/laravel-generators
[link-author]: https://github.com/tswonke
[link-contributors]: ../../contributors
