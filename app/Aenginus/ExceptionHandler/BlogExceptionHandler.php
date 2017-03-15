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

namespace Aenginus\ExceptionHandler;

use Exception;
use Illuminate\Http\Request;
use Aenginus\Exception\CommentNotAllowedException;

/**
 * CommentHelper.
 *
 * @trait
 */
class BlogExceptionHandler
{
    /**
     * ...
     *
     * @param \Illuminate\Http\Request $request
     * @param \Exception               $exception
     *
     * @return mixed
     */
    public function handler(Request $request, Exception $exception)
    {
        if ($request->expectsJson()) {
            $msg = 'Sorry, something went wrong.';
            if ($exception instanceof CommentNotAllowedException) {
                $msg = 'Sorry, comment is not allowed now.';
            }

            return response()->json([
                'status' => $exception->getCode(),
                'msg'    => $msg
            ]);
        }

        return false;
    }
}

/* <> */
