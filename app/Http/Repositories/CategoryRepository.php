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

namespace App\Http\Repositories;

use App\Category;
use App\Post;
use Illuminate\Http\Request;

/**
 * CategoryRepository.
 *
 * @package App\Http\Repository
 */
class CategoryRepository extends Repository
{

    /**
     * ...
     *
     * @var string
     * @static
     */
    protected static $tag = 'category';


    /**
     * ...
     *
     * @return \App\Category
     * @access public
     */
    public function model()
    {
        return app(Category::class);
    }


    /**
     * ...
     *
     * @return mixed
     */
    public function getAll()
    {
        $categories = $this->remember('category.all', function () {
            return Category::withCount('posts')->get();
        });

        return $categories;
    }


    /**
     * ...
     *
     * @param string $name
     *
     * @return mixed
     */
    public function get($name)
    {
        $category = $this->remember("category.one.{$name}", function () use ($name) {
            return Category::where('name', $name)->first();
        });

        if (!$category) {
            abort(404);
        }

        return $category;
    }


    /**
     * ...
     *
     * @param \App\Category $category
     * @param integer       $page
     *
     * @return mixed
     */
    public function pagedPostsByCategory(Category $category, $page = 7)
    {
        $posts = $this->remember(
            "category.posts.{$category->name}{$page}". request()->get('page', 1),
            function () use ($category, $page) {
                return $category
                    ->posts()
                    ->select(Post::selectArrayWithOutContent)
                    ->with([ 'tags', 'category' ])
                    ->withCount('comments')
                    ->orderBy('created_at', 'desc')
                    ->paginate($page);
            }
        );

        return $posts;
    }


    /**
     * ...
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \App\Category
     */
    public function create(Request $request)
    {
        $this->clearCache();

        return Category::create([
            'name' => $request['name']
        ]);
    }


    /**
     * ...
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Category            $category
     *
     * @return boolean|integer
     */
    public function update(Request $request, Category $category)
    {
        $this->clearCache();

        return $category->update($request->all());
    }


    /**
     * ...
     *
     * @return string
     */
    public function tag()
    {
        return CategoryRepository::$tag;
    }
}

/* <> */
