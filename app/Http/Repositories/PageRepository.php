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

use App\Configuration;
use App\Page;
use Illuminate\Http\Request;
use Parsedown;

/**
 * Class PageRepository
 * @package App\Http\Repository
 */
class PageRepository extends Repository
{
    static $tag = 'page';
    protected $parseDown;

    public function __construct()
    {
        $this->parseDown = new Parsedown();
    }

    public function model()
    {
        return app(Page::class);
    }

    /**
     * @param $name string
     * @return mixed
     */
    public function get($name)
    {
        $page = $this->remember('page.one.' . $name, function () use ($name) {
            return Page::where('name', $name)->with('configuration')->withCount(['comments'])->first();
        });

        if (!$page)
            abort(404);
        return $page;
    }

    public function getAll()
    {
        $page = $this->remember('page.all.', function () {
            return Page::select(['id', 'name', 'display_name'])->with('configuration')->get();
        });

        if (!$page)
            abort(404);
        return $page;
    }

    /**
     * @param Request $request
     * @return Page
     */
    public function create(Request $request)
    {
        $this->clearCache();
        $page = Page::create(array_merge(
            $request->except('_token'),
            ['html_content' => $this->parseDown->text($request->get('content'))]
        ));

        $page->saveConfig($request->all());
        return $page;
    }

    public function update(Request $request, Page $page)
    {
        $this->clearCache();
        $page->saveConfig($request->all());
        return $page->update(array_merge(
            $request->except('_token'),
            ['html_content' => $this->parseDown->text($request->get('content'))]
        ));
    }

    public function tag()
    {
        return PageRepository::$tag;
    }
}

/* <> */
