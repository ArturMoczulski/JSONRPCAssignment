<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

namespace MeetingsAPI\Data;

/**
 * A class for representing meeting data objects
 */
class Meeting
{

  /**
   * @param array $data Data as decoded from JSON
   */
  public function __construct($data) {
    foreach ($data as $attrName => $attrVal) {
      $this->$attrName = $attrVal;
    }
  }

  public function toString() {
    return $this->meeting_name.": ".$this->raw_address;
  }

}
