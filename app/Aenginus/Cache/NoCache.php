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

namespace App\Aenginus\Cache;


use App\Contracts\AenginusCache;
use Closure;

class NoCache implements AenginusCache
{
    public function setTag($tag)
    {
        // Do Nothing
    }

    public function setTime($time_in_minute)
    {
        // Do Nothing
    }

    public function remember($key, Closure $entity, $tag = null)
    {
        /**
         * directly return
         */
        return $entity();
    }

    public function forget($key, $tag = null)
    {
        // Do Nothing
    }


    public function clearCache($tag = null)
    {
        // Do Nothing
    }


    public function clearAllCache()
    {
        // Do Nothing
    }
}

/* <> */
