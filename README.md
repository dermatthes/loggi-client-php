# rudl-client-php
Cluster logging (UDP) client driver for PHP 5/7


## Features

Loggi sends fast UDP Messages to a central Logging Instance. It transmits
Hostname and ressource usage information for every request. All data is
encrypted with a Private/Publickey.

Loggi will create a private/publickey pair for every single UnitToken.

UDP data is beeing send encrypted to the endpoint.

Initialize Loggi:

```
$driver = new LogDriver("<token>", "https://endpoint-url");
$driver->setPublicKeyCache("/tmp/");
$driver->connect();

```

This command will try to read the loggi - config-file from /tmp/loggi-<sha1_of_token>.json

If it is not found or outdated, loggi will connect the endpoint-url via tcp to obtain a
new config-file.

## Loggi-Conf Format

```
{
    "version": "1",
    "sysId": "Xz7B4",
    "validTo": timestamp, 
    "publicKey": "Public KEy"
}
```

The configuration-file is normally valid for one week.


## Features

- Error/Exception Logging
- Ressource Usage (Process-Time, Memory-Usage, Data-Transfer) by IP and User
- Individual Logging (e.g. Click-Through rates, A/B Tests)

### Error-Logging

Register Loggi Error/Exception Logging:



### Request-Based resource logging


