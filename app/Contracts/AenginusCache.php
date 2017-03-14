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

namespace App\Contracts;

use Closure;

interface AenginusCache
{
    public function setTag($tag);

    public function setTime($time_in_minute);

    public function remember($key, Closure $entity, $tag = null);

    public function forget($key, $tag = null);

    public function clearCache($tag = null);

    public function clearAllCache();
}

/* <> */
