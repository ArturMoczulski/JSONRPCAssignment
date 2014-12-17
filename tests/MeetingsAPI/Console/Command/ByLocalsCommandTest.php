<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

namespace MeetingsAPI\Tests\Console\Command;

use MeetingsAPI\Console\Command\ByLocalsCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;

class ByLocalsCommandTest extends \PHPUnit_Framework_TestCase
{

  public function testExecute() {
    $app = new Application();
    $app->add(new ByLocalsCommand());

    $cmd = $app->find('api:ByLocals');
    $cmdTester = new CommandTester($cmd);
    $cmdTester->execute(
      array(
        'command' => $cmd->getName(),
      )
    );

    $this->assertRegExp('/byLocals/', $cmdTester->getDisplay());
  }

}
