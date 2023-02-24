# Drop foreign if exist

Add method dropForeignIfExists in Blueprint for Postgresql. 

# Support Policy

| Package Version | Laravel Version |
|:---------------:|:---------------:|
|        1        |        9        |
|        1        |        8        |
|   not support   |       <=7       |

# Testing

See workflow testing.yml. For example Laravel 9.
```shell
docker pull i3bepb/php-for-test:1.0.0-php-8.1.16-cli-alpine3.17
```

Run container with volume
```shell
docker run --rm -it -v $(pwd):/home/www-data/application i3bepb/php-for-test:1.0.0-php-8.1.16-cli-alpine3.17 sh
```

In container
```shell
composer install && php vendor/bin/testbench package:test --do-not-cache-result
```

## Support orchestra/testbench

| laravel  | testbench  |
|:--------:|:----------:|
|   9.x    |    7.x     |
|   8.x    |    6.x     |
|   7.x    |    5.x     |
|   6.x    |    4.x     |

## Support nunomaduro/collision

| testbench | nunomaduro/collision |
|:---------:|:--------------------:|
|    7.x    |         6.x          |
|    6.x    |         5.x          |
|    5.x    |         4.x          |
