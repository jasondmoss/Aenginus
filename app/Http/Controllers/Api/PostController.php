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

namespace App\Http\Controllers\Api;

use App\Http\Repositories\PostRepository;
use App\Post;

class PostController extends ApiController
{
    protected $postRepository;

    /**
     * PostController constructor.
     * @param PostRepository $postRepository
     */
    public function __construct(PostRepository $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        return $this->result(
            Post::select(['slug', 'title', 'description', 'posts.created_at', 'categories.name as categoryName'])
                ->leftJoin('categories', 'posts.category_id', '=', 'categories.id')
                ->orderBy('posts.created_at', 'desc')
                ->get()
        );
    }

    public function html()
    {
        $post = Post::select('html_content')->where('slug', request('slug'))->first();
        if ($post == null)
            return $this->result('not found', 404);
        return $this->result(
            $post->html_content
        );
    }
}

/* <> */
