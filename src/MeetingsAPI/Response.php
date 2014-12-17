<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

namespace MeetingsAPI;

/**
 * The response received from the MettingsAPI endpoint
 */
class Response
{

  /**
   * @var array
   */
  protected $content;

  public function __construct($content) {
    $this->content = $content;
  }

  /**
   * @return array
   */
  public function content() { return $this->content; }
}
