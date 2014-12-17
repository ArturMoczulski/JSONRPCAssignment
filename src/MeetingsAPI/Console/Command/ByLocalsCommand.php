<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

namespace MeetingsAPI\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * ByLocals command is a CLI wrapper for the "byLocals" method of
 * the http://tools.referralsolutionsgroup.com/meetings-api/v1/
 * endpoint.
 * @see http://symfony.com/doc/current/components/console/introduction.html
 */
class ByLocalsCommand extends Command
{
  protected function configure() {
    $this
      ->setName('api:ByLocals')
      ->setDescription('CLI wrapper for byLocals of the MeetingsAPI')
    ;
  }

  protected function execute(InputInterface $input, OutputInterface $output) {
    $output->writeln('byLocals');
  }
}
