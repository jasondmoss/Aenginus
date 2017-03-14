<?php
/**
 * Created by PhpStorm.
 * User: lufficc
 * Date: 2016/10/5
 * Time: 0:00
 */

namespace App\Observers;


use App\Contracts\AenginusCache;
use App\Http\Controllers\GeneratedController;
use App\Page;

class PageObserver
{
    protected $xblogCache;

    public function saved(Page $page)
    {
        $this->getAenginusCache()->clearCache();
    }

    /**
     * @return AenginusCache
     */
    private function getAenginusCache()
    {
        if ($this->xblogCache == null) {
            $this->xblogCache = app('AenginusCache');
            $this->xblogCache->setTag(GeneratedController::tag);
        }
        return $this->xblogCache;
    }
}
