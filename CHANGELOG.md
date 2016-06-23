# Composer configuration reader changelog

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
