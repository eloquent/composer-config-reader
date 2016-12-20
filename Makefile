test: install
	php --version
	vendor/bin/phpunit --no-coverage

coverage: install
	phpdbg --version
	phpdbg -qrr vendor/bin/phpunit

open-coverage:
	open coverage/index.html

lint: test/bin/php-cs-fixer
	test/bin/php-cs-fixer fix --using-cache no

install: vendor/autoload.php

.PHONY: test coverage open-coverage lint install

vendor/autoload.php: composer.lock
	composer install

composer.lock: composer.json
	composer update

test/bin/php-cs-fixer:
	curl -sSL https://github.com/FriendsOfPHP/PHP-CS-Fixer/releases/download/v2.0.0/php-cs-fixer.phar -o test/bin/php-cs-fixer
	chmod +x test/bin/php-cs-fixer
