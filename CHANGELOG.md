# Changelog

All notable changes to `laravel-generators` will be documented in this file.

Updates should follow the [Keep a CHANGELOG](http://keepachangelog.com/) principles.

## NEXT - YYYY-MM-DD

### Added
- Nothing

### Deprecated
- Nothing

### Fixed
- Nothing

### Removed
- Nothing

### Security
- Nothing

## 3.3.3 - 2018-03-16

### Added 

- support for Laravel 5.8

## 3.3.0 - 2018-11-16

### Added

- add setRequiredFields() by default

## 3.2.0 - 2018-11-11

### Added

- use "open in IDE" also via `config` or `.env` - see README for details
- strip spaces from schema-string

### Changed

- output naming classes only with -v (verbose) option

## 3.1.0 - 2018-06-25

### Added

- Opener classes for Sublime and VS Code

## 3.0.0 - 2018-06-24 - Complete Refactoring

The Refactoring is supposed to provide new functions more easily in the future.

Attention: `schema` has been changed and only registered FieldTypes (see config-file) will be parsed. There are only a few FieldTypes available at the moment, more will come soon.

### Added

- `AddToGitService`: using `--git` in command will add all files to git

### Changed

- The parsing of `--schema=""` is now a bit different, but much more powerful. Please see Readme for further information
- Naming for each service is handled by dedicated classes and can be accessed everywhere (e.g. name of Model inside a CrudController)

### Removed

- additional commands which are now integrated in the corresponding services

## 2.1.0 - 2018-03-30 (for Backpack Base v0.9)

### Added
- `SidebarService` adds an entry to your sidebar

### Changed
- `RouteService` now uses `routes/backpack/custom.php

## 2.0.0 - 2018-03-23

### Added
- `LanguageFileService` generates models.php translation file (if not exists) and fill singular/plural translation
- `OpenIdeService` opens all generated file with PhpStorm if command is called with `--ide={ide}`
- `RouteService` adds Backpack Crud route to admin.php

### Changed

- `BackpackCrudModelService` will fill `$fillable` in Model automatically from scheme (if given)
- `BackpackCrudRequestService` will fill `rules()` in Request automatically from scheme (if given)
- `BackpackCrudControllerService` will add CrudFields and CrudColumns in Controller automatically from scheme (if given) - very rudimentary for now, more functionality planned

## 1.2.0 - 2018-03-18

### Added
- integrate backpack crud commands and stubs

## 1.1.1 - 2018-03-17

### Fixed
- function calls for conversion names

## 1.1.0 - 2018-03-17

### Added
- --schema option for migrations

## 1.0.0 - 2018-03-16

### Added
- initial Version
