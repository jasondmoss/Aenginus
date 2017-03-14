<?php

namespace App\Aenginus\Cache;


use App\Contracts\XblogCache;
use Closure;

class NoCache implements XblogCache
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
