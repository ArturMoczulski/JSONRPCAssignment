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

  protected $collection;

  public function __construct($collection = array()) {
    $this->collection = $collection;
  }

  /**
   * @param array &$meetings
   * @param array $from Location from which to sort
   */
  public static function sortByDistance($from, $asc = true) {
  }

}
