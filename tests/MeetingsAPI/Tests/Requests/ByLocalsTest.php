<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

namespace MeetingsAPI\Tests\Requests;

use MeetingsAPI\Requests\ByLocals;
use MeetingsAPI\Tests\MockServerTestCase;
use Guzzle\Tests\GuzzleTestCase;
use Guzzle\Http\Message\Response as GuzzleResponse;

class ByLocalsTest extends GuzzleTestCase
{

  /**
   * @covers \MeetingsAPI\Requests\ByLocals::getAPIMethodName
   */
  public function testGetAPIMethodName() {
    $this->assertEquals('byLocals', ByLocals::getAPIMethodName());
  }

  /**
   * This test cases uses Guzzle's mock server to mock server responses.
   * @covers \MeetingsAPI\Requests\ByLocals::call
   * @dataProvider providerCall
   * @group mockserver
   */
  public function testCall($testData) {
    $mock = new GuzzleResponse($testData['mock']['status']);
    $mock->setBody($testData['mock']['body']);
    foreach( $testData['mock']['headers'] as $header ) {
      $mock->addHeader($header);
    }
    $this->getServer()->enqueue(array($mock));
    ByLocals::$ENDPOINT_URL = $this->getServer()->getUrl();

    $response = ByLocals::execute($testData['args']);

    $this->assertInstanceOf('\MeetingsAPI\Response', $response);

    $json_mock = json_decode($testData['mock']['body'],true);
    $this->assertEquals(
      $json_mock['result'],
      $response->content(),
      "Actual response doesn't match the expected mock response."
    );
  }

  public function providerCall() {
    return array(
      array(
        array(
          'args' => array(
            'state_abbr' => 'CA',
            'city' => 'San Diego'
          ),
          'mock' => array(
            'status' => 200,
            'headers' => array(),
            // there was a bug in the sample response provided with the assignment (a missing comma)
            'body' => '
{  
   "jsonrpc":"2.0",
   "id": 1,
   "result":[  
      {  
         "id":60954,
         "time_id":15455,
         "address_id":25475,
         "type":"MeetingItem",
         "details":"Format: Contact: Adriana - 619-397-7010",
         "meeting_type":"OA",
         "meeting_name":"Chula Vista Presbyterian Church",
         "language":"English",
         "raw_address":"Chula Vista Presbyterian Church, 940 Hilltop Drive, Chula Vista, , CA",
         "location":"Chula Vista Presbyterian Church",
         "address":{  
            "id":25475,
            "street":"940 Hilltop Dr",
            "zip":"91911",
            "city":"Chula Vista",
            "state_abbr":"CA",
            "lat":"32.623718461538",
            "lng":"-117.05943523077"
         },
         "time":{  
            "id":15455,
            "day":"monday",
            "hour":1930
         }
      },
      {  
         "id":60955,
         "time_id":15414,
         "address_id":25476,
         "type":"MeetingItem",
         "details":"Format: Contact: Rosalinda - 619-992-5974",
         "meeting_type":"OA",
         "meeting_name":"Scripps Hospital",
         "language":"English",
         "raw_address":"Scripps Hospital, 499 H St, Chula Vista, , CA",
         "location":"Scripps Hospital",
         "address":{  
            "id":25476,
            "street":"",
            "zip":"91914",
            "city":"Chula Vista",
            "state_abbr":"CA",
            "lat":"32.656159",
            "lng":"-116.966139"
         },
         "time":{  
            "id":15414,
            "day":"tuesday",
            "hour":1900
         }
      }
    ]
}
'
          )
        )
      )
    );
  }

}
