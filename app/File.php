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

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * File.
 *
 */
class File extends Model
{

    /**
     * ...
     *
     * @var array
     */
    protected $fillable = [ 'name', 'key', 'size', 'type' ];
}

/* <> */
