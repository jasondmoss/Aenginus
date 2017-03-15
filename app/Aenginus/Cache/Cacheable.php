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

namespace Aenginus\Cache;

use App\Contracts\AenginusCache;
use Closure;

/**
 * Cacheable.
 *
 */
class Cacheable implements AenginusCache
{

    /**
     * ...
     *
     * @var string
     */
    public $tag;

    /**
     * ...
     *
     * @var integer
     */
    public $cacheTime;


    /**
     * ...
     *
     * @param string $tag
     *
     * @return string
     * @access public
     */
    public function setTag($tag)
    {
        $this->tag = $tag;
    }


    /**
     * ...
     *
     * @param string   $key
     * @param \Closure $entity
     * @param string   $tag
     *
     * @return string
     * @access public
     */
    public function remember($key, Closure $entity, $tag = null)
    {
        return cache()->tags($tag == null ? $this->tag : $tag)->remember($key, $this->cacheTime, $entity);
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
        cache()->tags($tag == null ? $this->tag : $tag)->forget($key);
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
        cache()->tags($tag == null ? $this->tag : $tag)->flush();
    }


    /**
     * ...
     *
     * @access public
     */
    public function clearAllCache()
    {
        cache()->flush();
    }


    /**
     * ...
     *
     * @param integer
     *
     * @access public
     */
    public function setTime($timeInMinute)
    {
        $this->cacheTime = $timeInMinute;
    }
}

/* <> */
