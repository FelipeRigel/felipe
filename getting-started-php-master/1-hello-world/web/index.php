<?php

/*
 * Copyright 2015 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 */


die ("Hello".$_POST["param1"]);
// [START index_php]
require_once __DIR__ . '/../vendor/autoload.php';

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
 //use \storage\iot-cars-v2:librerias\SilexMaster\src\Silex\Provider\TwigServiceProvider;
 //use Symfony\Component\HttpFoundation\Request;


 // create the Silex application
 $app = new Application();
 $app->register(new TwigServiceProvider());
 $app['twig.path'] = [ __DIR__ ];

 $app->get('/', function () use ($app) {
     /** @var PDO $db */
     $db = $app['database'];
     /** @var Twig_Environment $twig */
     $twig = $app['twig'];
#hola   
     // Show existing guestbook entries.
     $results = $db->query('SELECT * FROM vehiculo');
   
     echo 'Resultado = ' . $results;
 });

