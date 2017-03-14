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

class Configuration extends Model
{
    protected $fillable = ['config'];
    public $timestamps = false;

    public function configurable()
    {
        return $this->morphTo();
    }

    public function getConfigAttribute($meta)
    {
        $a = json_decode($meta, true);
        return $a ? $a : array();
    }

    public function setConfigAttribute($meta)
    {
        $this->attributes['config'] = json_encode($meta);
    }
}

/* <> */
