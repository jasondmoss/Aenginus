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

namespace Aenginus\Comment;

use AenginusConfig;

/**
 * CommentHelper.
 *
 * @trait
 */
trait CommentHelper
{

    /**
     * ...
     *
     * @return array
     * @access public
     */
    public function getCommentInfo()
    {
        $commentConfig = $this->commentConfig ? $this->commentConfig->config : null;
        if (!$commentConfig) {
            $commentConfig = [];
            $commentConfig['comment_info'] = 'default';
            $commentConfig['commentType'] = 'default';
        }

        return $commentConfig;
    }


    /**
     * ...
     *
     * @return boolean
     * @access public
     */
    public function isShownComment()
    {
        $commentConfig = $this->getCommentInfo();

        return $commentConfig['comment_info'] != 'force_disable'
            && ($commentConfig['comment_info'] == 'force_enable' || AenginusConfig::getValue('commentType') != 'none');
    }


    /**
     * ...
     *
     * @return boolean
     * @access public
     */
    public function allowComment()
    {
        $allowResourceComment = $this->getConfig('allowResourceComment', 'default');

        return $allowResourceComment == 'default'
            ? AenginusConfig::getBoolValue('allow_comment', true)
            : $this->getBoolConfig('allowResourceComment', true);
    }


    /**
     * ...
     *
     * @return string
     * @access public
     */
    public function getCommentType()
    {
        $commentType = AenginusConfig::getValue('commentType', 'raw');
        $commentable_config = $this->getCommentInfo()['commentType'];

        return ($commentable_config == 'default' ? $commentType : $commentable_config);
    }
}

/* <> */
