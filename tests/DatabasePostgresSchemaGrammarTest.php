<?php

namespace I3bepb\DropForeignIfExist\Tests;

use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\PostgresGrammar;
use Mockery;
use Orchestra\Testbench\TestCase;

class DatabasePostgresSchemaGrammarTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            'I3bepb\DropForeignIfExist\ServiceProvider',
        ];
    }

    protected function tearDown(): void
    {
        Mockery::close();
    }

    /**
     * Get the database connection.
     *
     * @param  string|null  $connection
     * @param  string|null  $table
     * @return \Illuminate\Database\Connection
     */
    protected function getConnection($connection = null, $table = null)
    {
        return Mockery::mock(Connection::class);
    }

    public function getGrammar()
    {
        return new PostgresGrammar;
    }

    /**
     * @test
     */
    public function drop_foreign_if_exists()
    {
        // Check when param string
        $blueprint = new Blueprint('users');
        $blueprint->dropForeignIfExists('order_id_foreign');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);
        $this->assertSame('alter table "users" drop constraint if exists "order_id_foreign"', $statements[0]);

        // Check when param array
        $blueprint = new Blueprint('users');
        $blueprint->dropForeignIfExists(['order_id']);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);
        $this->assertSame('alter table "users" drop constraint if exists "users_order_id_foreign"', $statements[0]);
    }
}