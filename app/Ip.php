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
 * Ip.
 *
 * @uses \App\Comment
 * @uses \App\User
 */
class Ip extends Model
{

    /**
     * ...
     *
     * @var boolean
     */
    public $incrementing = false;

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
    protected $fillable = [ 'id', 'user_id' ];


    /**
     * ...
     *
     * @return
     * @access public
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * ...
     *
     * @return
     * @access public
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

/* <> */
