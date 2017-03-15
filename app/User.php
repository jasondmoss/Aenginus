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

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * User.
 *
 * @uses \App\Post
 */
class User extends Authenticatable
{

    use  Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'email', 'password', 'avatar' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'password', 'remember_token' ];


    /**
     * ...
     *
     * @param array
     *
     * @return array
     * @access public
     */
    public function getMetaAttribute($meta)
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
    public function setMetaAttribute($meta)
    {
        $this->attributes['meta'] = json_encode($meta);
    }


    /**
     * ...
     *
     * @return
     * @access public
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

/* <> */
