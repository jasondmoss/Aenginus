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

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use AenginusConfig;

/**
 * SettingsComposer.
 *
 */
class SettingsComposer
{

    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     *
     * @access public
     */
    public function compose(View $view)
    {
        $view->with(AenginusConfig::getArrayByTag('settings'));
    }
}

/* <> */
