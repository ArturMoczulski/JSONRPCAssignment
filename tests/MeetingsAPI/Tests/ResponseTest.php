<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

namespace MeetingsAPI\Tests;

use MeetingsAPI\Response;

class ByLocalsTest extends \PHPUnit_Framework_TestCase
{

  /**
   * @covers \MeetingsAPI\Response::content
   */
  public function testContent() {
    $expected = array("foo");
    $response = new Response($expected);
    $this->assertEquals($expected, $response->content());
  }

}
