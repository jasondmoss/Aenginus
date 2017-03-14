<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/8/25
 * Time: 13:07
 */

namespace App\Http\Repositories;

use App\Contracts\AenginusCache;
use Closure;

abstract class Repository
{
    /**
     * @var AenginusCache
     */
    private $xblogCache;

    public abstract function model();

    public abstract function tag();

    private function getAenginusCache()
    {
        if ($this->xblogCache == null) {
            $this->xblogCache = app('AenginusCache');
            $this->xblogCache->setTag($this->tag());
            $this->xblogCache->setTime($this->cacheTime());
        }
        return $this->xblogCache;
    }

    public function cacheTime()
    {
        return 60;
    }

    public function count()
    {
        $count = $this->remember($this->tag() . '.count', function () {
            return $this->model()->count();
        });
        return $count;
    }

    public function all()
    {
        $all = $this->remember($this->tag() . '.all', function () {
            return $this->model()->all();
        });
        return $all;
    }

    public function remember($key, Closure $entity, $tag = null)
    {
        return $this->getAenginusCache()->remember($key, $entity, $tag);
    }

    public function forget($key, $tag = null)
    {
        $this->getAenginusCache()->forget($key, $tag);
    }

    public function clearCache($tag = null)
    {
        $this->getAenginusCache()->clearCache($tag);
    }

    public function clearAllCache()
    {
        $this->getAenginusCache()->clearAllCache();
    }

}
