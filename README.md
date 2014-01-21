# Composer configuration reader

*A light-weight component for reading Composer configuration files.*

[![Semantic versioning shield]][Semantic versioning]
[![Build status shield]][Latest build status]
[![Test coverage shield]][Test coverage report]

## Installation and documentation

* Available as [Composer] package [eloquent/composer-config-reader].
* [API documentation] available.

## Usage

Composer configuration reader is very simple to use, and a quick example should
be self-explanatory:

````php
$reader = new Eloquent\Composer\Configuration\ConfigurationReader;
$configuration = $reader->read('/path/to/composer.json');

echo $configuration->name(); // outputs the package name
```

## Configuration objects

The following are the objects used to represent the configuration information.
For a more detailed overview of the data available, simply look through the
class definition (these classes are very simple).

The following classes all exist in the `Eloquent\Composer\Configuration\Element`
namespace.

### [Configuration]

This is the main configuration object and has methods to access all the
information available in the [Composer schema].

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

### [Repository], [PackageRepository]

These objects describe the package's defined repositories.

All repositories are represented by the `Repository` class, except for
package-type repositories which use the `PackageRepository` class.

See [Repositories].

#### Example methods

* `type()`: The repository type.
* `url()`: The repository URL (not available for `PackageRepository`).

### [Stability]

This object is a simple [enumeration] with the following members:

* DEV
* ALPHA
* BETA
* RC
* STABLE

It is currently only used to represent the value of the [minimum-stability]
option.

### [Author]

This object contains all information provided for a specific author.

See [authors].

#### Example methods

* `name()`: The author's name.
* `email()`: The author's email address.

### [SupportInformation]

This object describes the package's support contact information.

See [support].

#### Example methods

* `email()`: The support email address.
* `issues()`: The URL of the issue tracking system.
* `wiki()`: The URL of the wiki system.

### [ProjectConfiguration]

This object describes configuration options specific to end-projects, such as
the target directories for various resources provided by Composer.

See [config].

#### Example methods

* `vendorDir()`: The project's vendor directory path.
* `binDir()`: The project's binary directory path.

### [ScriptConfiguration]

This object describes the Composer scripts defined by the package.

See [Scripts].

#### Example methods

* `preInstallCmd()`: The pre-install scripts.
* `postInstallCmd()`: The post-install scripts.

<!-- References -->

[Author]: src/Element/Author.php
[authors]: http://getcomposer.org/doc/04-schema.md#authors
[Composer schema]: http://getcomposer.org/doc/04-schema.md
[config]: http://getcomposer.org/doc/04-schema.md#config
[Configuration]: src/Element/Configuration.php
[enumeration]: https://github.com/eloquent/enumeration
[minimum-stability]: http://getcomposer.org/doc/04-schema.md#minimum-stability
[PackageRepository]: src/Element/PackageRepository.php
[ProjectConfiguration]: src/Element/ProjectConfiguration.php
[Repositories]: http://getcomposer.org/doc/05-repositories.md
[Repository]: src/Element/Repository.php
[ScriptConfiguration]: src/Element/ScriptConfiguration.php
[Scripts]: http://getcomposer.org/doc/articles/scripts.md
[Stability]: src/Element/Stability.php
[support]: http://getcomposer.org/doc/04-schema.md#support
[SupportInformation]: src/Element/SupportInformation.php

[API documentation]: http://lqnt.co/composer-config-reader/artifacts/documentation/api/
[Build status shield]: http://b.adge.me/travis/eloquent/composer-config-reader/develop.svg
[Composer]: http://getcomposer.org/
[eloquent/composer-config-reader]: https://packagist.org/packages/eloquent/composer-config-reader
[Latest build status]: https://travis-ci.org/eloquent/composer-config-reader
[Semantic versioning]: http://semver.org/
[Test coverage report]: https://coveralls.io/r/eloquent/composer-config-reader
[Test coverage shield]: http://b.adge.me/coveralls/eloquent/composer-config-reader/develop.svg
[Semantic versioning shield]: http://b.adge.me/:semver-2.0.0-green.svg
