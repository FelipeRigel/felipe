<?php
/*
 * Copyright 2015 Google Inc. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *   http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */

namespace Google\Cloud\Samples\Bookshelf;

use Silex\WebTestCase;

/**
 * Test for application controllers
 */
class AppTest extends WebTestCase
{
    use GetConfigTrait;

    /**
     * Creates the application.
     *
     * @return \Symfony\Component\HttpKernel\HttpKernelInterface
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../../src/app.php';

        $app['config'] = $this->getConfig();

        return $app;
    }

    public function testBookshelfModel()
    {
        $config = $this->app['config'];

        // Test CloudSql
        $config['bookshelf_backend'] = 'cloudsql';
        $this->app['config'] = $config;

        $this->assertInstanceOf(
            'Google\Cloud\Samples\Bookshelf\DataModel\CloudSql',
            $this->app['bookshelf.model']
        );

        // Test Datastore
        $config['bookshelf_backend'] = 'datastore';
        $this->app['config'] = $config;

        $this->assertInstanceOf(
            'Google\Cloud\Samples\Bookshelf\DataModel\Datastore',
            $this->app['bookshelf.model']
        );

        // Test MongoDB
        $config['bookshelf_backend'] = 'mongodb';
        $this->app['config'] = $config;

        $this->assertInstanceOf(
            'Google\Cloud\Samples\Bookshelf\DataModel\MongoDb',
            $this->app['bookshelf.model']
        );
    }

    /**
     * @expectedException DomainException
     * @expectedExceptionMessage "bookshelf_backend" must be set in bookshelf config
     */
    public function testBookshelfBackendException()
    {
        $config = $this->app['config'];

        // Test invalid backend
        $config['bookshelf_backend'] = '';
        $this->app['config'] = $config;

        $model = $this->app['bookshelf.model'];
    }

    /**
     * @expectedException DomainException
     * @expectedExceptionMessage Invalid "bookshelf_backend" given: foo. Possible values are cloudsql, mongodb, or datastore.
     */
    public function testBookshelfModelException()
    {
        $config = $this->app['config'];

        // Test invalid backend
        $config['bookshelf_backend'] = 'foo';
        $this->app['config'] = $config;

        $model = $this->app['bookshelf.model'];
    }

    public function testPubsubServer()
    {
        // smoke test
        $server = $this->app['pubsub.server'];
        $server->loop->tick();
    }
}
