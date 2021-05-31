<?php

use Database\Factories\TopicFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Application;
use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use DatabaseMigrations;
    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function createTestTopic(): Model
    {
        return (new TopicFactory())->createOne([
            'name' => 'topic1'
        ]);
    }
}
