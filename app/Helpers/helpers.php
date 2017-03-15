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

use App\User;

if (!function_exists('isAdmin')) {
    /**
     * ...
     *
     * @param \App\User $user
     *
     * @return boolean
     */
    function isAdmin($user)
    {
        return $user != null && $user instanceof User && $user->id === 1;
    }
}


if (!function_exists('isAdminById')) {
    /**
     * ...
     *
     * @param integer $user_id
     *
     * @return
     */
    function isAdminById($user_id)
    {
        return $user_id === 1;
    }
}


if (!function_exists('getAdminUser')) {
    /**
     * ...
     *
     * @return \App\User
     */
    function getAdminUser()
    {
        return User::findOrFail(1);
    }
}


if (!function_exists('getMilliseconds')) {
    /**
     * ...
     *
     * @return integer
     */
    function getMilliseconds()
    {
        return round(microtime(true) * 1000);
    }
}


if (!function_exists('array_safe_get')) {
    /**
     * ...
     *
     * @param array  $array
     * @param string $key
     * @param string $default
     *
     * @return mixed
     */
    function array_safe_get($array, $key, $default = '')
    {
        if (array_has($array, $key)) {
            return $array[$key];
        }

        return $default;
    }
}


if (!function_exists('getUrlEndWithSlash')) {
    /**
     * ...
     *
     * @param string $url
     *
     * @return string
     */
    function getUrlEndWithSlash($url)
    {
        if (!ends_with($url, '/')) {
            return "{$url}/";
        }

        return $url;
    }
}


if (!function_exists('getUrlByFileName')) {
    /**
     * ...
     *
     * @param string $fileName
     *
     * @return string
     */
    function getUrlByFileName($fileName)
    {
        /**
         * https domain first.
         */
        $qiniu_domain = empty(config('filesystems.disks.qiniu.domains.https'))
            ? getUrlEndWithSlash(config('filesystems.disks.qiniu.domains.default'))
            : getUrlEndWithSlash(config('filesystems.disks.qiniu.domains.https'));

//         if ($qiniu_domain) {
//             $qiniu_domain = getUrlEndWithSlash($qiniu_domain);
//         } else {
//             $qiniu_domain = getUrlEndWithSlash($qiniu_domain = config('filesystems.disks.qiniu.domains.default'));
//         }

        return $qiniu_domain . $fileName;
    }
}


if (!function_exists('processImageViewUrl')) {
    /**
     * ...
     *
     * @param string  $rawImageUrl
     * @param integer $width
     * @param integer $height
     * @param boolean $mode
     *
     * @return string
     */

    function processImageViewUrl($rawImageUrl, $width = null, $height = null, $mode = 1)
    {
        $para = "?imageView2/{$mode}";

        if ($width) {
            $para = "{$para}/w/{$width}";
        }

        if ($height) {
            $para = "{$para}/h/{$height}";
        }

        return $rawImageUrl . $para;
    }
}


if (!function_exists('getImageViewUrl')) {
    /**
     * ...
     *
     * @param string  $key
     * @param integer $width
     * @param integer $height
     * @param boolean $mode
     *
     * @return string
     *
     * @see http://developer.qiniu.com/code/v6/api/kodo-api/image/imageview2.html
     */
    function getImageViewUrl($key, $width = null, $height = null, $mode = 1)
    {
        return processImageViewUrl(getUrlByFileName($key), $width, $height, $mode);
    }
}


if (!function_exists('formatBytes')) {
    /**
     * ...
     *
     * @param integer $size
     * @param integer $precision
     *
     * @return integer
     */
    function formatBytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = [ ' bytes', ' KB', ' MB', ' GB', ' TB' ];

            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        }

        return $size;
    }
}


if (!function_exists('getMentionedUsers')) {
    /**
     * ...
     *
     * @param string $content
     *
     * @return \App\User
     */
    function getMentionedUsers($content)
    {
        preg_match_all("/(\S*)\@([^\r\n\s]*)/i", $content, $tmpAtList);
        $usernames = [];

        foreach ($tmpAtList[2] as $k => $v) {
            if ($tmpAtList[1][$k] || strlen($v) > 25) {
                continue;
            }

            $usernames[] = $v;
        }

        $users = User::whereIn('name', array_unique($usernames))->get();

        return $users;
    }
}


if (!function_exists('httpUrl')) {
    /**
     * ...
     *
     * @param string $url
     *
     * @return string
     */
    function httpUrl($url)
    {
        if ($url == null || $url == '') {
            return '';
        }

        if (!starts_with($url, 'http')) {
            return "http://{$url}";
        }

        return $url;
    }
}

/* <> */
