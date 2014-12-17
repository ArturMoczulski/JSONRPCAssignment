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
  //abstract public static function execute($args = array(), $url = "");

  /**
   * private constructor ensures the use of the call() factory method
   */
  private function __construct() {}

  /**
   * performing an API call; also a factory method for Response objects
   * @param array $args
   * @param $url (optional)
   * @return Response
   */
  public static function call($args = array()) {
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
