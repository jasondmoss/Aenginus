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

use App\Http\Repositories\CategoryRepository;
use Illuminate\View\View;

/**
 * CategoriesComposer.
 *
 */
class CategoriesComposer
{

    /**
     * ...
     *
     * @var \App\Http\Repositories\CategoryRepository
     */
    protected $categoryRepository;


    /**
     * Create a new profile composer.
     *
     * @param \App\Http\Repositories\CategoryRepository $categoryRepository
     *
     * @internal param \App\Http\Repositories\UserRepository $users
     *
     * @access public
     */
    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }


    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     *
     * @access public
     */
    public function compose(View $view)
    {
        $categories = $this->categoryRepository->getAll()->reject(function ($category) {
            return $category->posts_count == 0;
        });

        $view->with('categories', $categories);
    }
}

/* <> */
