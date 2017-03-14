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

use Illuminate\Http\Request;

/**
 * Class TagRepository
 * @package App\Http\Repository
 */
class UnknownFileRepository extends FileRepository
{
    protected $tag;

    public function setTag($tag)
    {
        $this->tag = $tag;
    }

    public function upload(Request $request, $delete = false, $fileName = 'file')
    {
        if ($delete) {
            $this->deleteAllByType();
        }
        $file = $request->file($fileName);
        return $this->uploadFile($file, $file->getClientOriginalName());
    }

    public function tag()
    {
        return $this->tag;
    }

    public function type()
    {
        return $this->tag;
    }
}

/* <> */
