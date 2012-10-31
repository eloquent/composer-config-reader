# Composer configuration reader

*A light-weight component for reading Composer configuration files.*

## Installation

Composer configuration reader requires PHP 5.3 or later.

### With [Composer](http://getcomposer.org/)

* Add 'eloquent/composer-config-reader' to the project's composer.json
  dependencies
* Run `composer install`

### Bare installation

* Clone from GitHub: `git clone git://github.com/eloquent/composer-config-reader.git`
* Use a [PSR-0](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md)
  compatible autoloader (namespace 'Eloquent\Composer\Configuration' in the
  'src' directory)

## Usage

Composer configuration reader is very simple to use and a quick example should
be self-explanatory:

````php
<?php

$reader = new Eloquent\Composer\Configuration\ConfigurationReader;
$configuration = $reader->read('/path/to/composer.json');

echo $configuration->name(); // outputs the package name
```

## Configuration objects

The following are the domain objects used to represent the configuration
information. For a more detailed overview of the data available, simply look
through the class definition (these classes are very simple).

The following classes all exist in the `Eloquent\Composer\Configuration\Domain`
namespace.

### [Configuration](https://github.com/eloquent/composer-config-reader/blob/master/src/Eloquent/Composer/Configuration/Domain/Configuration.php)

This is the main configuration object and has methods to access all the
information available in the [Composer schema](http://getcomposer.org/doc/04-schema.md).

#### Example methods

* `name()`: The package name.
* `description()`: The package description.
* `dependencies()`: Equivalent to Composer `require`.
* `devDependencies()`: Equivalent to Composer `require-dev`.
* `autoloadPSR0()`: The autoload information for PSR-0 namespaces/paths.
* `autoloadClassmap()`: The autoload information for classmapped paths.

#### Helper methods

A number of helper methods exist on the main configuration object to simplify
the process of extracting useful information:

* `projectName()`: The project name without the vendor prefix.
* `vendorName()`: The vendor name without the project suffix.
* `allDependencies()`: Combines `require` and `require-dev` into a single array.
* `allPSR0SourcePaths()`: A flat array of all PSR-0-compliant source paths.
* `allSourcePaths()`: A flat array of all source paths.

### [Repository](https://github.com/eloquent/composer-config-reader/blob/master/src/Eloquent/Composer/Configuration/Domain/Repository.php), [PackageRepository](https://github.com/eloquent/composer-config-reader/blob/master/src/Eloquent/Composer/Configuration/Domain/PackageRepository.php)

These objects describe the package's defined repositories.

All repositories are represented by the `Repository` class, except for
package-type repositories which use the `PackageRepository` class.

See [Repositories](http://getcomposer.org/doc/05-repositories.md).

#### Example methods

* `type()`: The repository type.
* `url()`: The repository URL (not available for `PackageRepository`).

### [Stability](https://github.com/eloquent/composer-config-reader/blob/master/src/Eloquent/Composer/Configuration/Domain/Stability.php)

This object is a simple [enumeration](https://github.com/eloquent/enumeration)
with the following members:

* DEV
* ALPHA
* BETA
* RC
* STABLE

It is currently only used to represent the value of the
[minimum-stability](http://getcomposer.org/doc/04-schema.md#minimum-stability)
option.

### [Author](https://github.com/eloquent/composer-config-reader/blob/master/src/Eloquent/Composer/Configuration/Domain/Author.php)

This object contains all information provided for a specific author.

See [authors](http://getcomposer.org/doc/04-schema.md#authors).

#### Example methods

* `name()`: The author's name.
* `email()`: The author's email address.

### [SupportInformation](https://github.com/eloquent/composer-config-reader/blob/master/src/Eloquent/Composer/Configuration/Domain/SupportInformation.php)

This object describes the package's support contact information.

See [support](http://getcomposer.org/doc/04-schema.md#support).

#### Example methods

* `email()`: The support email address.
* `issues()`: The URL of the issue tracking system.
* `wiki()`: The URL of the wiki system.

### [ProjectConfiguration](https://github.com/eloquent/composer-config-reader/blob/master/src/Eloquent/Composer/Configuration/Domain/ProjectConfiguration.php)

This object describes configuration options specific to end-projects, such as
the target directories for various resources provided by Composer.

See [config](http://getcomposer.org/doc/04-schema.md#config).

#### Example methods

* `vendorDir()`: The project's vendor directory path.
* `binDir()`: The project's binary directory path.

### [ScriptConfiguration](https://github.com/eloquent/composer-config-reader/blob/master/src/Eloquent/Composer/Configuration/Domain/ScriptConfiguration.php)

This object describes the Composer scripts defined by the package.

See [Scripts](http://getcomposer.org/doc/articles/scripts.md).

#### Example methods

* `preInstallCmd()`: The pre-install scripts.
* `postInstallCmd()`: The post-install scripts.

## Code quality

Composer configuration reader strives to attain a high level of quality. A full
test suite is available, and code coverage is closely monitored.

### Latest revision test suite results
[![Build Status](https://secure.travis-ci.org/eloquent/composer-config-reader.png)](http://travis-ci.org/eloquent/composer-config-reader)

### Latest revision test suite coverage
<http://ci.ezzatron.com/report/composer-config-reader/coverage/>
