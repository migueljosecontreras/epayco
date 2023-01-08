<?php

use Laravel\Lumen\Testing\TestCase as BaseTestCase;
use App\Traits\Common\RequestServiceTrait;
abstract class TestCase extends BaseTestCase
{
    use RequestServiceTrait;
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }
}
