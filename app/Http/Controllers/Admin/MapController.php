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

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Http\Repositories\MapRepository;
use Illuminate\Http\Request;
use App\Http\Requests;

class MapController extends Controller
{
    protected $mapRepository;

    /**
     * MapController constructor.
     * @param MapRepository $mapRepository
     */
    public function __construct(MapRepository $mapRepository)
    {
        $this->mapRepository = $mapRepository;
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'key' => 'required|unique:maps',
            'value' => 'required',
        ]);
        if ($this->mapRepository->create($request))
            return back()->with('success', '保存成功');
        else
            return back()->withErrors('保存失败哦');
    }

    public function get($key)
    {
        $map = $this->mapRepository->get($key);
        if (is_null($map))
            abort(404);
        return $map;
    }
}

/* <> */
