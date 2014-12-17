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
}
