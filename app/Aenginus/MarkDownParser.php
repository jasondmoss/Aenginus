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

namespace Aenginus;

use League\HTMLToMarkdown\HtmlConverter;
use Parsedown;

/**
 * MarkDownParser.
 *
 */
class MarkDownParser
{

    /**
     * ...
     *
     * @var \League\HTMLToMarkdown\HtmlConverter
     */
    protected $parseDown;

    /**
     * ...
     *
     * @var \Parsedown
     */
    protected $htmlConverter;


    /**
     * MarkDownParser constructor.
     *
     * @access public
     */
    public function __construct()
    {
        $this->parseDown = new Parsedown();
        $this->htmlConverter = new HtmlConverter();
    }


    /**
     * ...
     *
     * @param string $html
     *
     * @return string
     * @access public
     */
    public function html2md($html)
    {
        return $this->htmlConverter->convert($html);
    }


    /**
     * ...
     *
     * @param string  $markdown
     * @param boolean $clean
     *
     * @return string
     * @access public
     */
    public function parse($markdown, $clean = true)
    {
        $convertedHtml = $this->parseDown->setBreaksEnabled(true)->text($markdown);
        if ($clean) {
            $convertedHtml = clean($convertedHtml, 'user_comment_content');
        }

        return $convertedHtml;
    }
}

/* <> */
