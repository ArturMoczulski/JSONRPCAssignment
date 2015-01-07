<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

namespace MeetingsAPI\Requests;

use MeetingsAPI\Response;
use MeetingsAPI\Data\Meeting;
use MeetingsAPI\Data\Meetings;

/**
 * An PHP wrapper around the "byLocals" method of the MeetingsAPI
 */
class ByLocals extends AbstractRequest
{
  public static function getAPIMethodName() { return 'byLocals'; }

  /**
   * @param string stateAbbr
   * @param string city
   * @return Meeting
   */
  public static function call($stateAbbr, $city) {
    return parent::call(array(array(array(
      'state_abbr' => $stateAbbr,
      'city' => $city
    ))));
  }

  /**
   * object mapping
   * @param array $args
   * @param Response $response
   * @return Meetings
   */
  public static function doLogic($args, Response $response) {
    $meetings = array();
    foreach ($response->content() as $meetingData) {
      $meetings [$meetingData['id']]= new Meeting($meetingData);
    }
    return new Meetings($meetings);
  }
}
