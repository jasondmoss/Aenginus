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

/**
 * Kernel.
 *
 * @interface
 */
interface AenginusCache
{

    /**
     * ...
     *
     * @param string $tag
     *
     * @access public
     */
    public function setTag($tag);


    /**
     * ...
     *
     * @param integer $timeInMinute
     *
     * @access public
     */
    public function setTime($timeInMinute);


    /**
     * ...
     *
     * @param string   $key
     * @param \Closure $entity
     * @param string   $tag
     *
     * @access public
     */
    public function remember($key, Closure $entity, $tag = null);


    /**
     * ...
     *
     * @param string $key
     * @param string $tag
     *
     * @access public
     */
    public function forget($key, $tag = null);


    /**
     * ...
     *
     * @param string $tag
     *
     * @access public
     */
    public function clearCache($tag = null);


    /**
     * ...
     *
     * @access public
     */
    public function clearAllCache();
}

/* <> */
