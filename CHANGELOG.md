# Composer configuration reader changelog

## 3.0.0 (2020-11-16)

- **[BC BREAK]** PHP <7.2 is no longer supported.

## 2.1.0 (2017-11-02)

- **[IMPROVED]** Added support for maps in `config.preferred-install` ([#12]).

[#12]: https://github.com/eloquent/composer-config-reader/issues/12

## 2.0.2 (2016-12-20)

- **[IMPROVED]** Removed dependency on [Isolator].
- **[FIXED]** Configurations that use repository name can now be parsed
  ([#10], [#11] - thanks [@spipu]).

[#10]: https://github.com/eloquent/composer-config-reader/issues/10
[#11]: https://github.com/eloquent/composer-config-reader/pull/11
[@spipu]: https://github.com/spipu
[isolator]: https://github.com/IcecaveStudios/isolator

## 2.0.1 (2016-06-23)

- **[FIXED]** Configurations that disable the Packagist repo can now be parsed
  ([#7]).

[#7]: https://github.com/eloquent/composer-config-reader/issues/7

## 2.0.0 (2014-01-22)

- **[BC BREAK]** Element class constructors expanded to accomodate new Composer
  configuration settings
- **[BC BREAK]** `Domain` namespace renamed to `Element`
- **[BC BREAK]** Interfaces renamed to match naming conventions
- **[BC BREAK]** Method names containing acronyms are now CamelCased properly
- **[BC BREAK]** All enumerations have updated APIs as per enumeration version
  upgrade
- **[MAINTENANCE]** General repository maintenance

## 1.1.2 (2013-03-04)

- **[NEW]** [Archer] integration
- **[NEW]** Implemented changelog

[archer]: https://github.com/IcecaveStudios/archer
