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

use App\Scopes\PublishedScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;
use Aenginus\Comment\CommentHelper;
use Aenginus\Config\ConfigureHelper;

/**
 * Post.
 *
 * @uses \App\Category
 * @uses \App\Comment
 * @uses \App\Configuration
 * @uses \App\Tag
 * @uses \App\User
 */
class Post extends Model
{

    use SoftDeletes, CommentHelper, ConfigureHelper;


    /**
     * ...
     *
     * @var array
     * @constant
     */
    const selectArrayWithOutContent = [
        'id',
        'user_id',
        'category_id',
        'title',
        'slug',
        'view_count',
        'description',
        'updated_at',
        'created_at',
        'status'
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [ 'deleted_at', 'published_at' ];

    /**
     * ...
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'slug',
        'category_id',
        'user_id',
        'content',
        'published_at',
        'status',
        'html_content'
    ];


    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new PublishedScope());
    }


    /**
     * ...
     *
     * @return
     * @access public
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    /**
     * ...
     *
     * @return
     * @access public
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
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


    /**
     * ...
     *
     * @return
     * @access public
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }


    /**
     * ...
     *
     * @return
     * @access public
     */
    public function configuration()
    {
        return $this->morphOne(Configuration::class, 'configurable');
    }


    /**
     * ...
     *
     * @return boolean
     * @access public
     */
    public function isPublished()
    {
        return $this->status == 1;
    }


    /**
     * ...
     *
     * @return array
     * @access public
     */
    public function getConfigKeys()
    {
        return [
            'allowResourceComment',
            'commentType',
            'comment_info'
        ];
    }
}

/* <> */
