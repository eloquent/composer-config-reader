# Composer configuration reader

*A light-weight component for reading Composer configuration files.*

[![Current version image][version-image]][current version]
[![Current build status image][build-image]][current build status]
[![Current coverage status image][coverage-image]][current coverage status]

[build-image]: http://img.shields.io/travis/eloquent/composer-config-reader/master.svg?style=flat-square "Current build status for the master branch"
[coverage-image]: https://img.shields.io/codecov/c/github/eloquent/composer-config-reader/master.svg?style=flat-square "Current test coverage for the master branch"
[current build status]: https://travis-ci.org/eloquent/composer-config-reader
[current coverage status]: https://codecov.io/github/eloquent/composer-config-reader
[current version]: https://packagist.org/packages/eloquent/composer-config-reader
[version-image]: https://img.shields.io/packagist/v/eloquent/composer-config-reader.svg?style=flat-square "This project uses semantic versioning"

## Installation and documentation

- Available as [Composer] package [eloquent/composer-config-reader].

[composer]: http://getcomposer.org/
[eloquent/composer-config-reader]: https://packagist.org/packages/eloquent/composer-config-reader

## Usage

Composer configuration reader is very simple to use, and a quick example should
be self-explanatory:

```php
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

[composer schema]: http://getcomposer.org/doc/04-schema.md
[configuration]: src/Element/Configuration.php

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

[packagerepository]: src/Element/PackageRepository.php
[repositories]: http://getcomposer.org/doc/05-repositories.md
[repository]: src/Element/Repository.php

#### Example methods

* `type()`: The repository type.
* `url()`: The repository URL (not available for `PackageRepository`).

### [Stability]

This object is an [enumeration] of package stabilities, with the following
members:

* DEV
* ALPHA
* BETA
* RC
* STABLE

It is currently only used to represent the value of the [minimum-stability]
option.

[enumeration]: https://github.com/eloquent/enumeration
[minimum-stability]: http://getcomposer.org/doc/04-schema.md#minimum-stability
[stability]: src/Element/Stability.php

### [Author]

This object contains all information provided for a specific author.

See [authors].

[author]: src/Element/Author.php
[authors]: http://getcomposer.org/doc/04-schema.md#authors

#### Example methods

* `name()`: The author's name.
* `email()`: The author's email address.

### [SupportInformation]

This object describes the package's support contact information.

See [support].

[support]: http://getcomposer.org/doc/04-schema.md#support
[supportinformation]: src/Element/SupportInformation.php

#### Example methods

* `email()`: The support email address.
* `issues()`: The URL of the issue tracking system.
* `wiki()`: The URL of the wiki system.

### [ProjectConfiguration]

This object describes configuration options specific to end-projects, such as
the target directories for various resources provided by Composer.

See [config].

[config]: http://getcomposer.org/doc/04-schema.md#config
[projectconfiguration]: src/Element/ProjectConfiguration.php

#### Example methods

* `vendorDir()`: The project's vendor directory path.
* `binDir()`: The project's binary directory path.

### [ScriptConfiguration]

This object describes the Composer scripts defined by the package.

See [Scripts].

[scriptconfiguration]: src/Element/ScriptConfiguration.php
[scripts]: http://getcomposer.org/doc/articles/scripts.md

#### Example methods

* `preInstallCmd()`: The pre-install scripts.
* `postInstallCmd()`: The post-install scripts.

### [ArchiveConfiguration]

This object describes the settings for creating package archives.

See [archive].

[archive]: http://getcomposer.org/doc/04-schema.md#archive
[archiveconfiguration]: src/Element/ArchiveConfiguration.php

#### Example methods

* `exclude()`: A list of file exclusion patterns.
