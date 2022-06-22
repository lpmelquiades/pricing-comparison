run-composer:
	docker run -v `pwd`:/app pricing-comparison-local sh -c "cd app && composer update"

run-test:
	docker build local-image -t pricing-comparison-local
	docker run -v `pwd`:/app pricing-comparison-local sh -c "cd app && composer update && composer dump-autoload && composer run testcept"

build-local:
	docker build local-image -t pricing-comparison-local