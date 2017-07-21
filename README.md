Poc Symfony 3 Rabbitmq
====================

A Symfony project created on May 30, 2017, 10:38 am.

**Example 1 (Topic)** : 
- **topic** exchange 
- 1 Producer,1 Exchange, 1 Queue, N Worker, 1 Consumer

Use postman (https://www.getpostman.com/) to create a leave request

**Url** : my_host:my_ip/leave_request/create

Leave request **json body** :

{
	
	"civility": "M.",
	"firstName": "Tintin",
	"lastName": "DUPONT",
	"createdAt": "2011-06-05 00:00:00",
	"validatedAt": "2011-06-08 00:00:00"
}

Scenario
--------


   1. **Request**: The user creates a leave request.
   2. **Controller**: Request gets validated and passed on to Service.
   3. **Service**: New leave request gets inserted into database, an leave request create event is created and the response is returned to user. This is where application process is finished so no more waiting time for user.
   4. **Event Dispatcher**: Picks up the event and dispatches it.
   5. **Event Listener**: Picks up dispatched event and passes it on to Producer.
   6. **Producer**: Creates a message and puts it into queue.
   7. **Consumer**: If the worker is running in terminal, it catches the message and processes it. If the worker is not running yet, it would start consuming messages later on when the worker is started.

Later when you want to consume 10 messages out of the `leave_request_qu` queue, you just run on the CLI:

```php
$ php bin/console rabbitmq:consumer -m 10 leave_request_create
```

All the examples expect a running RabbitMQ server.

After running the RabbitMQ server, open the url 127.0.0.1:15672 and log in with the username: guest and the password: guest