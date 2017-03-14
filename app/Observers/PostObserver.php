<?php

namespace App\Observers;


use App\Contracts\XblogCache;
use App\Http\Controllers\GeneratedController;
use App\Post;

class PostObserver
{
    protected $xblogCache;

    public function saved(Post $post)
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
