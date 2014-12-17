MeetingsAPI
==================

A project made for a test assignment

```usage
php src/application.php api:byLocals "[city]" "[state abbreviation]" "[day of the week, i.e. monday]" "[address to sort by]"
```

The assignment
==================

About JSON-RPC 2.0 - http://www.jsonrpc.org/specification
    
JSON-RPC 2.0 Server URL

```endpoint
http://tools.referralsolutionsgroup.com/meetings-api/v1/
```

The above web API has a method called "byLocals" that returns a list of Alcohol Anonymous and Narcotic Anonymous meetings within a given city or cities. A sample request and response are below.

Write a PHP script that requests all the meetings in San Diego, CA and sorts all **Monday meetings** by their distance from the below address.

You can and should use any PHP framework and/or libraries. e.g. a JSON-RPC 2.0 client library will be useful.

It is very easy to write ad-hoc, spaghetti code to solve this problem, but please use the opportunity to demonstrate **a few** of the following, or even add your own:

  * use of third party libraries
  * dependency management
  * design patterns
  * caching
  * use of a framework
  * unit testing

Address
--------
Sort results from closest to furthest from this address.

```address
517 4th Ave.
San Diego, CA 92101
```

Sample Request
---------------
```request
{
    "jsonrpc": "2.0",
    "id": 1,
    "method": "byLocals",
    "params": [
    	[
         	{"state_abbr": "CA", "city":"Chula Vista"}
    	]
    ]
}
```

Sample Response
----------------
* note that the below is truncated and that the actual request will return more than 2 results.

```response
{  
   "jsonrpc":"2.0"
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
      ...
    ]
}
````
