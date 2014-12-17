<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

namespace MeetingsAPI\Requests;

use MeetingsAPI\Response;
use JsonRPC\Client;

/**
 * Used for API calls to the endpoint
 */
abstract class AbstractRequest
{

  const ENDPOINT_URL = "http://tools.referralsolutionsgroup.com/meetings-api/v1/";

  abstract public function getAPIMethodName();

  /**
   * performing an API call; also a factory method for Response objects
   * @param array $args
   * @return Response
   */
  public static function call($args = array()) {
    return null;
  }
}
