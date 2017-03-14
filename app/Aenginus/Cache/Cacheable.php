<?php
namespace Aenginus\Cache;

/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/10/6
 * Time: 16:58
 */
use App\Contracts\AenginusCache;
use Closure;

class Cacheable implements AenginusCache
{
    public $tag;

    public $cacheTime;

    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    public function remember($key, Closure $entity, $tag = null)
    {
        return cache()->tags($tag == null ? $this->tag : $tag)->remember($key, $this->cacheTime, $entity);
    }


    public function forget($key, $tag = null)
    {
        cache()->tags($tag == null ? $this->tag : $tag)->forget($key);
    }

    public function clearCache($tag = null)
    {
        cache()->tags($tag == null ? $this->tag : $tag)->flush();
    }

    public function clearAllCache()
    {
        cache()->flush();
    }

    public function setTime($time_in_minute)
    {
        $this->cacheTime = $time_in_minute;
    }
}