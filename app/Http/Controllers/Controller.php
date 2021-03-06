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

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Gate;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function checkPolicy($ability, $model, $code = 403)
    {
        if (Gate::denies($ability, $model)) {
            abort($code);
        }
    }

    public function jsonMessage($msg = '', $code = 200)
    {
        return ['code' => $code, 'msg' => $msg];
    }

    public function succeedJsonMessage($msg = '')
    {
        return $this->jsonMessage($msg, 200);
    }

    public function failedJsonMessage($msg = '')
    {
        return $this->jsonMessage($msg, 500);
    }
}

/* <> */
