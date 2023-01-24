<?php

namespace I3bepb\DropForeignIfExists;

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
        Grammar::macro('compileDropForeignIfExists', function (Blueprint $blueprint, Fluent $command) {
            if (is_a($this, PostgresGrammar::class)) {
                return "alter table {$this->wrapTable($blueprint)} drop constraint if exists {$this->wrap($command->index)}";
            }
            throw new RuntimeException('The database driver in use does not support drop foreign if exist.');
        });
        Blueprint::macro('dropForeignIfExists', function ($index) {
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
