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

/**
 * Mention.
 *
 */
class NoCache implements AenginusCache
{

    /**
     * ...
     *
     * @param string $tag
     *
     * @access public
     */
    public function setTag($tag)
    {
        /**/
    }


    /**
     * ...
     *
     * @param integer $timeInMinute
     *
     * @return string
     * @access public
     */
    public function setTime($timeInMinute)
    {
        /**/
    }


    /**
     * ...
     *
     * @param string   $key
     * @param \Closure $content
     * @param string   $tag
     *
     * @return \Closure
     * @access public
     */
    public function remember($key, Closure $entity, $tag = null)
    {
        /**
         * Directly return.
         */
        return $entity();
    }


    /**
     * ...
     *
     * @param string $key
     * @param string $tag
     *
     * @access public
     */
    public function forget($key, $tag = null)
    {
        /**/
    }


    /**
     * ...
     *
     * @param string $tag
     *
     * @access public
     */
    public function clearCache($tag = null)
    {
        /**/
    }


    /**
     * ...
     *
     * @access public
     */
    public function clearAllCache()
    {
        /**/
    }
}

/* <> */
