# Middleware callable

[Psr-15 middleware](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-15-request-handlers.md) proxying a callable.

**Require** php >= 7.1

**Installation** `composer require ellipse/middleware-callable`

**Run tests** `./vendor/bin/kahlan`

- [Getting started](https://github.com/ellipsephp/middleware-callable#getting-started)

## Getting started

The class ```Ellipse\Middleware\CallableMiddleware``` can be wrapped around a callable in order to use it as a middleware.

As any middleware ```->process()``` method, the callable takes implementations of `Psr\Http\Message\ServerRequestInterface` and `Psr\Http\Server\RequestHandlerInterface` as parameter and should return an implementation of `Psr\Http\Message\ResponseInterface`.

```php
<?php

namespace App;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

use Ellipse\Middleware\CallableMiddleware;

// This middleware is wrapped around the given callable.
$middleware = new CallableMiddleware(function (ServerRequestInterface $request, RequestHandlerInterface $handler) {

    // ...

    return $handler->handle($request);

});

// The middleware ->process() method proxy the callable.
$response = $middleware->process($request, $handler);
```
