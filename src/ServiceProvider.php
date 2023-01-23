<?php

namespace I3bepb\DropForeignIfExist;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\Grammar;
use Illuminate\Database\Schema\Grammars\PostgresGrammar;
use Illuminate\Support\Fluent;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use RuntimeException;

class ServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap service
     *
     * @return void
     */
    public function boot()
    {
        Grammar::macro('compileDropForeignIfExist', function (Blueprint $blueprint, Fluent $command) {
            throw new RuntimeException('The database driver in use does not support drop foreign if exist.');
        });
        PostgresGrammar::macro('compileDropForeignIfExist', function (Blueprint $blueprint, Fluent $command) {
            return "alter table {$this->wrapTable($blueprint)} drop constraint if exists {$this->wrap($command->index)}";
        });
        Blueprint::macro('dropForeignIfExist', function ($index) {
            $columns = [];

            if (is_array($index)) {
                $index = $this->createIndexName('foreign', $columns = $index);
            }

            return $this->addCommand(
                'dropForeignIfExists', compact('index', 'columns')
            );
        });
    }
}
