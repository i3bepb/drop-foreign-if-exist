<?php

namespace I3bepb\DropForeignIfExists\Tests;

use I3bepb\DropForeignIfExists\ServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use ReflectionClass;

class TestCase extends BaseTestCase
{
    protected $blueprint;

    /**
     * Setup the test environment.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class,
        ];
    }

    /**
     * @param mixed $obj
     * @param string $prop Name protected property
     * @return mixed
     * @throws \ReflectionException
     */
    protected function accessProtected($obj, string $prop)
    {
        $reflection = new ReflectionClass($obj);
        $property = $reflection->getProperty($prop);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }
}