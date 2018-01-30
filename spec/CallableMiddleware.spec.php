<?php

use function Eloquent\Phony\Kahlan\stub;
use function Eloquent\Phony\Kahlan\mock;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

use Ellipse\Middleware\CallableMiddleware;

describe('CallableMiddleware', function () {

    beforeEach(function () {

        $this->callable = stub();

        $this->middleware = new CallableMiddleware($this->callable);

    });

    it('should implement MiddlewareInterface', function () {

        expect($this->middleware)->toBeAnInstanceOf(MiddlewareInterface::class);

    });

    describe('->process()', function () {

        it('should proxy the callable', function () {

            $request = mock(ServerRequestInterface::class)->get();
            $response = mock(ResponseInterface::class)->get();

            $handler = mock(RequestHandlerInterface::class)->get();

            $this->callable->with($request, $handler)->returns($response);

            $test = $this->middleware->process($request, $handler);

            expect($test)->toBe($response);

        });

    });

});
