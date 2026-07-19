<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected function setUpTraits()
    {
        if (config('database.default') !== 'sqlite' || config('database.connections.sqlite.database') !== ':memory:') {
            self::fail('Tests are not using the in-memory SQLite database — refusing to run so the real database is not wiped. Run `php artisan config:clear` and try again.');
        }

        return parent::setUpTraits();
    }
}
