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

class MarkDownParser
{
    protected $parseDown;
    protected $htmlConverter;

    /**
     * MarkDownParser constructor.
     */
    public function __construct()
    {
        $this->parseDown = new Parsedown();
        $this->htmlConverter = new HtmlConverter();
    }

    public function html2md($html)
    {
        return $this->htmlConverter->convert($html);
    }

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
