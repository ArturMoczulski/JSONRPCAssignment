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

  public static $ENDPOINT_URL = "http://tools.referralsolutionsgroup.com/meetings-api/v1/";
  public static $USERNAME = "oXO8YKJUL2X3oqSpFpZ5";
  public static $PASSWORD = "JaiXo2lZRJVn5P4sw0bt";

  abstract public static function getAPIMethodName();

  /**
   * private constructor ensures the use of the call() factory method
   */
  private function __construct() {}

  /**
   * additional server-side business logic
   * @param array $args
   * @param Response $response
   * @return mixed
   */
  protected static function doLogic($args, Response $response) { return $response; }

  /**
   * perform an API call and additional server-side business logic
   * @param array $args
   * @return mixed
   */
  public static function call($args = array()) {
    $response = static::doCall($args);
    return static::doLogic($args, $response);
  }

  /**
   * perform an API call; also a factory method for Response objects
   * @param array $args
   * @return Response
   */
  protected static function doCall($args = array()) {
    $url = $url ? $url : static::$ENDPOINT_URL;
    $request = new static();
    $client = new Client($url);
    $client->debug = true;
    $client->authentication(static::$USERNAME, static::$PASSWORD);
    $result = $client->execute($request->getAPIMethodName(), $args);

    if( $result ) {
      return new Response($result);
    } else {
      throw new \Exception("MettingsAPI: empty response receivd from the endpoint for request ".print_r($request, true));
    }
  }
}
