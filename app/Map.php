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
 * Map.
 *
 */
class Map extends Model
{

    /**
     * ...
     *
     * @var boolean
     */
    public $timestamps = false;

    /**
     * ...
     *
     * @var array
     */
    protected $fillable = [ 'key', 'value' ];
}

/* <> */
