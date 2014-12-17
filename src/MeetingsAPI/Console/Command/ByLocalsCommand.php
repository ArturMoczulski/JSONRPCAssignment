<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

namespace MeetingsAPI\Console\Command;

use MeetingsAPI\Requests\ByLocals;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputArgument;
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
      ->setName('api:byLocals')
      ->setDescription('CLI wrapper for byLocals of the MeetingsAPI')
      ->addArgument(
        'stateAbbr',
        InputArgument::REQUIRED,
        'What state? (provide abbreviation)'
      )
      ->addArgument(
        'city',
        InputArgument::REQUIRED,
        'What city do you want to search in?'
      )
    ;
  }

  protected function execute(InputInterface $input, OutputInterface $output) {
    $result = ByLocals::call(
      $input->getArgument('stateAbbr'),
      $input->getArgument('city')
    );

    foreach ($result as $location) {
      $output->writeln($location->toString());
    }
  }
}
