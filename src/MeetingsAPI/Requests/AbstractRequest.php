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
  public static $PASSWORD = "";

  abstract public static function getAPIMethodName();

  /**
   * private constructor ensures the use of the call() factory method
   */
  private function __construct() {}

  /**
   * additional server-side business logic
   * @param Response $response
   * @return mixed
   */
  protected static function doLogic(Response $response) { return $response; }

  /**
   * perform an API call and additional server-side business logic
   * @param array $args
   * @return mixed
   */
  public static function execute($args = array()) {
    $response = static::call($args);
    return static::doLogic($response);
  }

  /**
   * perform an API call; also a factory method for Response objects
   * @param array $args
   * @return Response
   */
  protected static function call($args = array()) {
    $url = $url ? $url : static::$ENDPOINT_URL;
    $request = new static();
    $client = new Client($url);
    $client->authentication(static::$USERNAME, static::$PASSWORD);
    $result = $client->execute($request->getAPIMethodName(), $args);

    if( $result ) {
      return new Response($result);
    } else {
      throw new \Exception("MettingsAPI: no repsponse for request ".print_r($request, true));
    }
  }
}