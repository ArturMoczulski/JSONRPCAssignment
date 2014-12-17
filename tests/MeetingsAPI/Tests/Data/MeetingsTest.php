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
  public function testSortByDistance($testData, $expected) {
    $meetings = new Meetings($testsData['meetings']);
    $meetings->sortByDistance(array());
    $order = 0;
    foreach ($meetings as $meeting) {
      $this->assertEquals($expected[$order], $meeting->id);
      $order++;
    }
  }

  public function providerSortByDistance() {
    $data = $this->providerMeetings();
    $data = array(
      array( // Test 1
        array( // Params
          array( // Param 1
            'meetings' => $data,
          ), // -- Param 1
          array(60594, 60595) // -- Param 2
        ), // -- Params
      ), // -- Test 1

      array( // Test 2
        array( // Params
          array( // Param 1
            'meetings' => $data,
            'day' => 'tuesday'
          ), // -- Param 1
          array(60594, 60595) // -- Param 2
        ), // -- Params
      ), // -- Test 2

      array( // Test 3
        array( // Params
          array( // Param 1
            'meetings' => $data,
            'day' => 'tuesday'
          ), // -- Param 1
          array(60594, 60595) // -- Param 2
        ), // -- Params
      ), // -- Test 3
    );
    return $data;
  }

  /**
   * @covers Meeting::filter
   * @dataProvider providerFilter
   */
  public function testFilter($data, $expected) {
    $meetings = new Meetings($data['meetings']);
    $meetings->filterByDayOfWeek('tuesday');

    foreach ($meetings->collection as $meeting) {
      $this->assertContains($meeting->id, $expected);
    }
    $this->assertEquals(count($expected), count($meetings->collection));

  }

  public function providerFilter() {
    $data = $this->providerMeetings();
    $data = array(
      array( // Test 1
        array( // Params
          array( // Param 1
            'meetings' => $data,
            'day' => 'tuesday'
          ), // -- Param 1
          array(60594) // -- Param 2
        ), // -- Params
      ), // -- Test 1

      array( // Test 2
        array( // Params
          array( // Param 1
            'meetings' => $data,
            'day' => 'tuesday'
          ), // -- Param 1
          array(60594) // -- Param 2
        ), // -- Params
      ), // -- Test 2

      array( // Test 3
        array( // Params
          array( // Param 1
            'meetings' => $data,
            'day' => 'tuesday'
          ), // -- Param 1
          array(60594) // -- Param 2
        ), // -- Params
      ), // -- Test 3
    );
    return $data;
  }

  public function providerMeetings() {
    return array(
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
    );
  }

}
