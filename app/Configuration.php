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
 * Configuration.
 *
 */
class Configuration extends Model
{

    /**
     * ...
     *
     * @var array
     */
    protected $fillable = [ 'config' ];

    /**
     * ...
     *
     * @var boolean
     */
    public $timestamps = false;


    /**
     * ...
     *
     * @return
     * @access public
     */
    public function configurable()
    {
        return $this->morphTo();
    }


    /**
     * ...
     *
     * @param array
     *
     * @return array
     * @access public
     */
    public function getConfigAttribute($meta)
    {
        $attr = json_decode($meta, true);

        return $attr ? $attr : [];
    }


    /**
     * ...
     *
     * @param array
     *
     * @return array
     * @access public
     */
    public function setConfigAttribute($meta)
    {
        $this->attributes['config'] = json_encode($meta);
    }
}

/* <> */
