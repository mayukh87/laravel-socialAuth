COMPOSER=composer --no-interaction

vendor:
	$(COMPOSER) install

putconfigs:
	mkdir -p config/
	cp -Rp dev/configSamples/*.php config/
	cp -Rp dev/configSamples/.envSample .env

phpcs: vendor
	./vendor/bin/phpcs --extensions=php --standard=dev/standard/citylife -s app/

phpmd: vendor
	./vendor/bin/phpmd app/ text dev/standard/phpmd.xml

codestyle: phpcs phpmd