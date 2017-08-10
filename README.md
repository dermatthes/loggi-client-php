# rudl-client-php

Cluster logging, request-tracking, accounting (UDP) client driver for PHP 5/7


## Features

This project is the client-side library. Check out __[Rudl - Open-Source Cluster Log Analyzer](https://github.com/dermatthes/rudl-frontend)__
to see it in Action. It's Big-Data (up to 190.000 requests/second per Rudl-instance). It's cluster aware. And it's setup within __30 seconds__ using zero config __docker container__.

- __Remote Logging__: Log hundreds of Servers, Projects, Microservices to one or more Rudl Endpoints
- __Fast & Reliable__: Rudl Messages are being sent by UDP. This is ***fast (<0.00001 sec/message)*** and reliable in case of Endpoint failure
- __Per Request Logging__: Rudl logs every single request including accounting information (CPU Time, Traffic consumed, Errors/Exceptions). Analyse performance issues or dos-attacks in an early stage. 
- __Big Data__: Analyze what you want using MongoDB Aggregation Framework and fancy graphing
- __PSR4 & Framework integration__: Rudl client integrates with your favorite Framework
- __Syslog aware__: Rudl is aware of the syslog remote logging protocol
- __Anonymizer__: Make your logs anonymous client-side

See our demos at __[Rudl - Open-Source Cluster Log Analyzer](https://github.com/dermatthes/rudl-frontend)__

## Easy to use

Install it using composer:

```
composer require rudl/logger
```

and setup the Request Logging:

```php
RudlClient::Init("rudl.endpoint.ip")
    ->setSystemId("FancyApp")
    ->registerExceptionHandler()
    ->registerRequestLogging();
```

That's it. This example will:

- Make this Project findable under its name `FancyApp`
- Log CPU Usage, Total Script time, Memory usage, Request, Traffic (in/out) for each request
- Log Exceptions

### Request-Based resource logging

``RudlClient::registerRequestLogging()`` will register a shutdown-function and log information about the
request including:

- CPU Time consumed
- CPU System Type consumed
- Memory Peak usage
- Total script runtime
- Hostname and Request URI
- Client IP-Address

### Exception Catching


