<?php

namespace App\Http\Controllers;

use App\Contracts\AenginusCache;
use App\Http\Requests;
use App\Page;
use App\Post;

class GeneratedController extends Controller
{
    const tag = 'generated';
    /**
     * @var AenginusCache
     */
    private $xblogCache;

    public function index()
    {
        $view = $this->getAenginusCache()->remember('generated.sitemap', function () {
            $posts = Post::select([
                'slug',
                'updated_at',
            ])->orderBy('created_at', 'desc')->get();

            $pages = Page::select(['id', 'name', 'display_name', 'updated_at'])->with('configuration')->get()->reject(function ($page) {
                $result = $page->configuration ? $page->configuration->config['display'] : 'false';
                return $result == 'false';
            });
            return view('generated.sitemap', compact('posts', 'pages'))->render();
        });
        return response($view)->header('Content-Type', 'text/xml');
    }

    public function feed()
    {
        $view = $this->getAenginusCache()->remember('generated.feed', function () {
            $posts = Post::select(Post::selectArrayWithOutContent)->orderBy('created_at', 'desc')->with('category', 'user')->get();
            return view('generated.feed', compact('posts'))->render();
        });
        return response($view)->header('Content-Type', 'text/xml');
    }

    /**
     * @return AenginusCache
     */
    private function getAenginusCache()
    {
        if ($this->xblogCache == null) {
            $this->xblogCache = app('AenginusCache');
            $this->xblogCache->setTag(GeneratedController::tag);
            $this->xblogCache->setTime(60 * 24);
        }
        return $this->xblogCache;
    }
}
