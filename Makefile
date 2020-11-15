# Powered by https://makefiles.dev/

PHP_SOURCE_FILES += etc/composer-schema.json

-include .makefiles/Makefile
-include .makefiles/pkg/php/v1/Makefile

.makefiles/%:
	@curl -sfL https://makefiles.dev/v1 | bash /dev/stdin "$@"
