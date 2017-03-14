<?php

namespace App\Observers;


use App\Contracts\XblogCache;
use App\Http\Controllers\GeneratedController;
use App\Page;

class PageObserver
{
    protected $xblogCache;

    public function saved(Page $page)
    {
        $this->getXblogCache()->clearCache();
    }

    /**
     * @return XblogCache
     */
    private function getXblogCache()
    {
        if ($this->xblogCache == null) {
            $this->xblogCache = app('XblogCache');
            $this->xblogCache->setTag(GeneratedController::tag);
        }
        return $this->xblogCache;
    }
}
