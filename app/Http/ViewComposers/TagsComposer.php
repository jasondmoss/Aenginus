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

use App\Http\Repositories\TagRepository;
use Illuminate\View\View;

/**
 * TagsComposer.
 *
 */
class TagsComposer
{

    /**
     * ...
     *
     * @var \App\Http\Repositories\TagRepository
     */
    protected $tagRepository;


    /**
     * Create a new profile composer.
     *
     * @param \App\Http\Repositories\TagRepositoryTagRepository $tagRepository
     *
     * @internal param \App\Http\Repositories\UserRepository $users
     *
     * @access public
     */
    public function __construct(TagRepository $tagRepository)
    {
        $this->tagRepository = $tagRepository;
    }


    /**
     * Bind data to the view.
     *
     * @param \Illuminate\View\View $view
     *
     * @return void
     * @access public
     */
    public function compose(View $view)
    {
        $tags = $this->tagRepository->getAll()->reject(function ($tag) {
            return $tag->posts_count == 0;
        });

        $view->with('tags', $tags);
    }
}

/* <> */
