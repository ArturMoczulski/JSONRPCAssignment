<?php

/*
 * Artur Moczulski <artur.moczulski@gmail.com>
 */

namespace MeetingsAPI\Tests\Console\Command;

use MeetingsAPI\Tests\Requests\ByLocalsTest;
use MeetingsAPI\Requests\ByLocals;
use MeetingsAPI\Console\Command\ByLocalsCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Tester\CommandTester;
use Guzzle\Tests\GuzzleTestCase;
use Guzzle\Http\Message\Response as GuzzleResponse;

class ByLocalsCommandTest extends GuzzleTestCase
{

  /**
   * @covers ByLocalsCommand::execute
   * @dataProvider providerExecute
   */
  public function testExecute($testData) {

    $mock = new GuzzleResponse($testData['mock']['status']);
    $mock->setBody($testData['mock']['body']);
    foreach( $testData['mock']['headers'] as $header ) {
      $mock->addHeader($header);
    }
    $this->getServer()->enqueue(array($mock));
    ByLocals::$ENDPOINT_URL = $this->getServer()->getUrl();

    $app = new Application();
    $app->add(new ByLocalsCommand());

    $cmd = $app->find('api:byLocals');
    $cmdTester = new CommandTester($cmd);
    $cmdTester->execute(
      array(
        'command' => $cmd->getName(),
        'city' => $testData['args']['city'],
        'stateAbbr' => $testData['args']['state_abbr'],
        'day' => $testData['args']['day'],
        'from' => $testData['args']['from']
      )
    );

    $jsonMock = json_decode($testData['mock']['body'],true);

    foreach ($jsonMock['result'] as $meetingData) {
      $this->assertRegExp('/'.$meetingData['meeting_name'].': '.$meetingData['meeting_name'].'/', $cmdTester->getDisplay());
    }
  }

  public function providerExecute() {
    return array(
      array(
        array(
          'args' => array(
            'state_abbr' => 'CA',
            'city' => 'San Diego',
            'day' => 'monday',
            'from' => '
517 4th Ave.
San Diego, CA 92101
            '
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
