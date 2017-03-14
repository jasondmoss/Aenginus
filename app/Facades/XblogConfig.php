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

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AenginusConfig extends Facade
{
    public static function getFacadeAccessor()
    {
        return 'AenginusConfig';
    }
}

/* <> */
