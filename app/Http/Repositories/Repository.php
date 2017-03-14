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

namespace App\Http\Repositories;

use App\Contracts\AenginusCache;
use Closure;

abstract class Repository
{
    /**
     * @var AenginusCache
     */
    private $aenginusCache;

    public abstract function model();

    public abstract function tag();

    private function getAenginusCache()
    {
        if ($this->aenginusCache == null) {
            $this->aenginusCache = app('AenginusCache');
            $this->aenginusCache->setTag($this->tag());
            $this->aenginusCache->setTime($this->cacheTime());
        }
        return $this->aenginusCache;
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

/* <> */
