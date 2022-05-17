install-php:
	sudo apt-get update \
	&& sudo apt-get install software-properties-common \
	&& sudo add-apt-repository ppa:ondrej/php \
	&& sudo apt-get update \
	&& sudo apt-get install php7.2 \
	&& sudo apt-get install php7.2-curl php7.2-gd php7.2-json php7.2-mbstring php7.2-intl php7.2-mysql php7.2-xml php7.2-zip php7.2-ds

install-composer:
	sudo curl -s https://getcomposer.org/installer | php \
	&& sudo mv composer.phar /usr/local/bin/composer \
	&& sudo rm -rf composer-setup.php

configure:
	composer update

test:
	composer run test