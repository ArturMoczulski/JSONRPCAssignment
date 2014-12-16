<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

namespace MeetingsAPI\MeetingsAPI;

use MeetingsAPI\Response;
use JsonRPC\Client;

/**
 * Used for API calls to the endpoint
 */
abstract class AbstractRequest
{

  /**
   * performing an API call; also a factory method for Response objects
   * @param array $args
   * @return Response
   */
  public static function call($args = array()) {
  }
}
