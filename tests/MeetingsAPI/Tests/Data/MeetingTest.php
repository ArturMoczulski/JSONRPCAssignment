<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

namespace MeetingsAPI\Tests\Data;

use MeetingsAPI\Data\Meeting;

class MeetingTest extends \PHPUnit_Framework_TestCase
{
  /**
   * @covers Meeting::toString
   * @dataProvider providerToString
   */
  public function testToString($data) {
    $meeting = new Meeting($data);
    $this->assertEquals("$data[meeting_name]: $data[raw_address]", $meeting->toString());
  }

  public function providerToString() {
    $data = $this->providerConstruct();
    foreach ($data as $i => $meeting) {
      $data[$i]['expected'] = "$meeting[meeting_name]: $meeting[raw_address]";
    }
    return $data;
  }

  /**
   * @covers Meeting::__construct
   * @dataProvider providerConstruct
   */
  public function testConstruct($testData) {
    $instance = new Meeting($testData);
    foreach ($testData as $attrName => $attrVal) {
      $this->assertEquals($attrVal, $instance->$attrName);
    }
  }

  public function providerConstruct() {
    return array (
      array (
        array(
          'id' => 60954,
          'time_id' => 15455,
          'address_id' => 25475,
          'type' => 'MeetingItem',
          'details' => 'Format: Contact: Adriana - 619-397-7010',
          'meeting_type' => 'OA',
          'meeting_name' => 'Chula Vista Presbyterian Church',
          'language' => 'English',
          'raw_address' => 'Chula Vista Presbyterian Church, 940 Hilltop Drive, Chula Vista, , CA',
          'location' => 'Chula Vista Presbyterian Church',
          'address' => 
          array (
            'id' => 25475,
            'street' => '940 Hilltop Dr',
            'zip' => '91911',
            'city' => 'Chula Vista',
            'state_abbr' => 'CA',
            'lat' => '32.623718461538',
            'lng' => '-117.05943523077',
          ),
          'time' => 
          array (
            'id' => 15455,
            'day' => 'monday',
            'hour' => 1930,
          ),
        ),
        array (
          'id' => 60955,
          'time_id' => 15414,
          'address_id' => 25476,
          'type' => 'MeetingItem',
          'details' => 'Format: Contact: Rosalinda - 619-992-5974',
          'meeting_type' => 'OA',
          'meeting_name' => 'Scripps Hospital',
          'language' => 'English',
          'raw_address' => 'Scripps Hospital, 499 H St, Chula Vista, , CA',
          'location' => 'Scripps Hospital',
          'address' => 
          array (
            'id' => 25476,
            'street' => '',
            'zip' => '91914',
            'city' => 'Chula Vista',
            'state_abbr' => 'CA',
            'lat' => '32.656159',
            'lng' => '-116.966139',
          ),
          'time' => 
          array (
            'id' => 15414,
            'day' => 'tuesday',
            'hour' => 1900,
          ),
        ),
      )
    );
  }
}
