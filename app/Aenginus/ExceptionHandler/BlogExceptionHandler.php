<?php

namespace Aenginus\ExceptionHandler;

use Exception;
use Illuminate\Http\Request;
use Aenginus\Exception\CommentNotAllowedException;

class BlogExceptionHandler
{
    /**
     * @param $request
     * @param Exception $exception
     * @return mixed
     */
    public function handler(Request $request, Exception $exception)
    {
        if ($request->expectsJson()) {
            $msg = 'Sorry, something went wrong.';
            if ($exception instanceof CommentNotAllowedException) {
                $msg = 'Sorry, comment is not allowed now.';
            }
            return response()->json(
                ['status' => $exception->getCode(), 'msg' => $msg]
            );
        }
        return false;
    }
}
