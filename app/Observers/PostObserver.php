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

namespace App\Observers;


use App\Contracts\AenginusCache;
use App\Http\Controllers\GeneratedController;
use App\Post;

class PostObserver
{
    protected $aenginusCache;

    public function saved(Post $post)
    {
        $this->getAenginusCache()->clearCache();
    }

    /**
     * @return AenginusCache
     */
    private function getAenginusCache()
    {
        if ($this->aenginusCache == null) {
            $this->aenginusCache = app('AenginusCache');
            $this->aenginusCache->setTag(GeneratedController::tag);
        }
        return $this->aenginusCache;
    }
}

/* <> */
