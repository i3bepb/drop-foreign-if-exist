# Drop foreign if exist

Add method dropForeignIfExists in Blueprint for Postgresql. 

# Support Policy

| Package Version | Laravel Version |
|:---------------:|:---------------:|
|        1        |        9        |
|        1        |        8        |
|   not support   |       <=7       |

#### Как запустить тесты используя docker

Скачиваем контейнер
```
docker pull composer:2.5.1
```

Запускаем контейнер с composer-ом, в который монтируем наши файлы
```
docker run --rm -it -v $(pwd):/app composer:2.5.1 sh
```

Запускаем тесты внутри контейнера
```shell
php vendor/bin/testbench package:test --do-not-cache-result
```

Запускаем конкретный тест
```shell
php vendor/bin/testbench package:test --filter 'I3bepb\\DropForeignIfExists\\Tests\\DatabasePostgresSchemaGrammarTest::drop_foreign_if_exists_with_string'
```

# Support orchestra/testbench

| laravel  | testbench  |
|:--------:|:----------:|
|   9.x    |    7.x     |
|   8.x    |    6.x     |
|   7.x    |    5.x     |
|   6.x    |    4.x     |

# Support nunomaduro/collision

| testbench | nunomaduro/collision |
|:---------:|:--------------------:|
|    7.x    |         6.x          |
|    6.x    |         5.x          |
|    5.x    |         4.x          |
