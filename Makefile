install-php:
	sudo apt-get update
	sudo apt-get install software-properties-common
	sudo add-apt-repository ppa:ondrej/php
	sudo apt-get update
	sudo apt-get install php7.2
	sudo apt-get install wget
	wget https://phar.phpunit.de/phpunit-6.4.phar
	chmod +x phpunit-6.4.phar
	sudo mv phpunit-6.4.phar /usr/local/bin/phpunit
	phpunit --version
	php --version
