<?php

namespace I3bepb\DropForeignIfExists\Tests;

use Illuminate\Database\Connection;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Schema\Grammars\PostgresGrammar;
use Mockery;
use ReflectionException;

class DatabasePostgresSchemaGrammarTest extends TestCase
{
    /**
     * Clean up the testing environment before the next test.
     *
     * @return void
     */
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

    /**
     * @return \Illuminate\Database\Schema\Grammars\PostgresGrammar
     */
    public function getGrammar()
    {
        return new PostgresGrammar;
    }

    /**
     * Check when param array
     *
     * @test
     */
    public function drop_foreign_if_exists_with_array()
    {
        $blueprint = new Blueprint('users');
        $blueprint->dropForeignIfExists(['order_id']);
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);
        $this->assertSame('alter table "users" drop constraint if exists "users_order_id_foreign"', $statements[0]);
    }

    /**
     * Check when param string
     *
     * @test
     */
    public function drop_foreign_if_exists_with_string()
    {
        $blueprint = new Blueprint('users');
        $blueprint->dropForeignIfExists('order_id_foreign');
        $statements = $blueprint->toSql($this->getConnection(), $this->getGrammar());
        $this->assertCount(1, $statements);
        $this->assertSame('alter table "users" drop constraint if exists "order_id_foreign"', $statements[0]);
    }

    /**
     * @test
     * @throws ReflectionException
     */
    public function check_macros_with_reflection_class()
    {
        $blueprint = new Blueprint('users');
        $macros = $this->accessProtected($blueprint, 'macros');
        $this->assertTrue(isset($macros['dropForeignIfExists']));
    }

    /**
     * @test
     * @throws ReflectionException
     */
    public function check_macros()
    {
        $blueprint = new Blueprint('users');
        $this->assertTrue($blueprint::hasMacro('dropForeignIfExists'));
    }
}