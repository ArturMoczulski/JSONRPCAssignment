<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

namespace MeetingsAPI\Data;

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
   * @param array $from Location from which to sort
   */
  public static function sortByDistance($from, $asc = true) {
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
