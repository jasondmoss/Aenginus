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

namespace App\Http\Controllers\Api;

class ApiController
{
    public function result($result, $code = 200)
    {
        return [
            'code' => $code,
            'data' => $result,
        ];
    }

    public function paginate($pagination)
    {
        return $pagination;
    }
}

/* <> */
