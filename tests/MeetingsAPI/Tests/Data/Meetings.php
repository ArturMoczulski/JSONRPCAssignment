<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

namespace MeetingsAPI\Tests\Data;

use MeetingsAPI\Data\Meetings;

class MeetingsTest extends \PHPUnit_Framework_TestCase
{
  /**
   * @covers Meeting::sortByDistance
   * @dataProvider providerSortByDistance
   */
  public function testSortByDistance($testData) {
  }

  public function providerSortByDistance() {
    return $this->providerConstruct();
  }
}
