<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

namespace MeetingsAPI\Requests;

use MeetingsAPI\Response;

/**
 * An PHP wrapper around the "byLocals" method of the MeetingsAPI
 */
class ByLocals extends AbstractRequest
{
  public static function getAPIMethodName() { return 'byLocals'; }

  /**
   * @param string stateAbbr
   * @param string city
   * @return mixed
   */
  public static function call($stateAbbr, $city) {
    return parent::call(array(
      'state_abbr' => $stateAbbr,
      'city' => $city
    ));
  }
}
