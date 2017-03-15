<?php

/**
 * Ænginus: Laravel Website Engine.
 *
 * @package    Laravel
 * @author     Jason D. Moss <jason@jdmlabs.com>
 * @copyright  2017 Jason D. Moss. All rights freely given.
 * @license    https://github.com/jasondmoss/aenginus/blob/master/LICENSE.md [WTFPL License]
 * @link       https://github.com/jasondmoss/aenginus/
 */

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Contracts\Container\Container;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Aenginus\ExceptionHandler\BlogExceptionHandler;

/**
 * Handler.
 *
 */
class Handler extends ExceptionHandler
{

    /**
     * @var \Aenginus\ExceptionHandler\BlogExceptionHandler
     */
    protected $blogExceptionHandler;

    /**
     * A list of the exception types that should not be reported.
     *
     * @var array
     */
    protected $dontReport = [
        \Illuminate\Auth\Access\AuthorizationException::class,
        \Illuminate\Auth\AuthenticationException::class,
        \Illuminate\Database\Eloquent\ModelNotFoundException::class,
        \Illuminate\Validation\ValidationException::class,
        \Symfony\Component\HttpKernel\Exception\HttpException::class
    ];


    /**
     * Handler constructor.
     *
     * @param \Illuminate\Contracts\Container\Container       $container
     * @param \Aenginus\ExceptionHandler\BlogExceptionHandler $blogExceptionHandler
     *
     * @access public
     */
    public function __construct(Container $container, BlogExceptionHandler $blogExceptionHandler)
    {
        parent::__construct($container);

        $this->blogExceptionHandler = $blogExceptionHandler;
    }


    /**
     * Report or log an exception.
     *
     * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
     *
     *
     * @param \Exception $exception
     *
     * @return void
     * @access public
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }


    /**
     * Render an exception into an HTTP response.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     *
     * @return \Illuminate\Http\Response
     * @access public
     */
    public function render($request, Exception $exception)
    {
        if (!$this->blogExceptionHandler->handler($request, $exception)) {
            return parent::render($request, $exception);
        }

        return $this->blogExceptionHandler->handler($request, $exception);
    }


    /**
     * Convert an authentication exception into an unauthenticated response.
     *
     * @param  \Illuminate\Http\Request                 $request
     * @param  \Illuminate\Auth\AuthenticationException $exception
     *
     * @return \Illuminate\Http\Response
     * @access protected
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json([
                'error' => 'Unauthenticated.'
            ], 401);
        }

        return redirect()->guest('login');
    }
}

/* <> */
