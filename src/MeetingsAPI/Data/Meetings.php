<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

namespace MeetingsAPI\Data;

use AnthonyMartin\GeoLocation\GeoLocation;

/**
 * A class for representing meetings DAO
 */
class Meetings
{

  public $collection;

  /**
   * @param array $collection Array of Meeting objects or raw associative arrays
   */
  public function __construct($collection = array()) {
    $this->collection = array();
    foreach ($collection as $entry) {
      if ($entry instanceof Meeting) {
        $this->collection []= $entry;
      } else {
        $this->collection []= new Meeting($entry);
      }
    }
  }

  /**
   * @param string $from Sort based on distance from this address
   * @param bool $asc (default: true)
   */
  public function sortByDistance($from, $asc = true) {
    $from = GeoLocation::getGeocodeFromGoogle($from);

    if (!isset($from->results[0]) ) {
      throw new \Exception('Unable to find address through Google Maps API');
    }

    $from = GeoLocation::fromDegrees(
      $from->results[0]->geometry->lat,
      $from->results[0]->geometry->lng
    );

    usort($this->collection, function($a, $b) use ($from, $asc) {
      $a = GeoLocation::fromDegrees($a->address['lat'], $a->address['lng']);
      $b = GeoLocation::fromDegrees($b->address['lat'], $b->address['lng']);
      $units = 'miles';

      if ($from->distanceTo($a,$units) < $from->distanceTo($b,$units)) {
        return $asc ? 1 : -1;
      } else if ($from->distanceTo($a,$units) == $from->distanceTo($b,$units)) {
        return 0;
      } else {
        return $asc ? -1 : 1;
      }
    });

  }

  /**
   * @param string $dayOfWeek
   */
  public function filterByDayOfWeek($day) {
    foreach ($this->collection as $key => $meeting) {
      if ($meeting->time['day'] != $day) {
        unset($this->collection[$key]);
      }
    }
  }

}
