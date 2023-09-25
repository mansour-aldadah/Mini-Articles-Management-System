<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function initDatabase()
    {
        \Artisan::call('migrate:fresh');
    }

    protected function resetDatabase()
    {
        \Artisan::call('migrate:reset');
    }
}
