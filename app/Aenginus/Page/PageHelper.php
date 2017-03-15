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

namespace Aenginus\Page;

/**
 * PageHelper.
 *
 * @uses \App\Page
 *
 * @trait
 */
trait PageHelper
{

    /**
     * ...
     *
     * @param \App\Page $page
     *
     * @return boolean
     * @access public
     */
    public function shouldShow($page)
    {
        if (isAdminById(auth()->id())) {
            return true;
        }

        if ($page->configuration && $page->configuration->config['display'] == 'true') {
            return true;
        }

        return false;
    }
}

/* <> */
