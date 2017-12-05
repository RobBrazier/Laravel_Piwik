<?php

namespace RobBrazier\Piwik\Repository\Config;

use Orchestra\Testbench\TestCase;

class FileConfigRepositoryTest extends TestCase
{

    private $key = "foo";
    private $value = "bar";

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set("piwik." . $this->key, $this->value);
    }

    public function testGet()
    {
        $repository = new FileConfigRepository();
        $value = $repository->get($this->key);
        $this->assertEquals($this->value, $value);
    }

}
