#!/usr/bin/env php
<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

require_once(dirname(__FILE__).'/../vendor/autoload.php');

use MeetingsAPI\Console\Command\ByLocalsCommand;
use Symfony\Component\Console\Application;

$app = new Application();
$app->add(new ByLocalsCommand());
$app->run();
