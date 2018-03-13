# Middleware callable

This package provides a [Psr-15](https://www.php-fig.org/psr/psr-15/) middleware proxying a callable.

**Require** php >= 7.0

**Installation** `composer require ellipse/middleware-callable`

**Run tests** `./vendor/bin/kahlan`

- [Using callables as middleware](#using-callables-as-middleware)

## Using callables as middleware

The class `Ellipse\Middleware\CallableMiddleware` can be wrapped around a callable in order to use it as a middleware.

As any middleware `->process()` method, the callable receive implementations of `Psr\Http\Message\ServerRequestInterface` and `Psr\Http\Server\RequestHandlerInterface` as parameters and should return an implementation of `Psr\Http\Message\ResponseInterface`.

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
