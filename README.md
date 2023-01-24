### Drop foreign if exist

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
php vendor/bin/testbench package:test
```

Запускаем конкретный тест
```shell
php vendor/bin/testbench package:test --filter 'I3bepb\\DropForeignIfExists\\Tests\\DatabasePostgresSchemaGrammarTest::drop_foreign_if_exists_with_string'
```