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

use App\Http\Repositories\PageRepository;
use Illuminate\View\View;

class PagesComposer
{

    protected $pageRepository;

    /**
     * Create a new profile composer.
     *
     * @internal param UserRepository $users
     * @param PageRepository $pageRepository
     */
    public function __construct(PageRepository $pageRepository)
    {
        $this->pageRepository = $pageRepository;
    }

    /**
     * Bind data to the view.
     *
     * @param  View $view
     * @return void
     */
    public function compose(View $view)
    {
        $pages = $this->pageRepository->getAll()->reject(function ($page) {
            $result = $page->configuration ? $page->configuration->config['display'] : 'false';
            return $result == 'false';
        })->sortBy(function ($page, $key) {
            $result = $page->configuration ? $page->configuration->config['sort_order'] : 1;
            return -$result;
        });
        $view->with('pages', $pages);
    }
}

/* <> */
