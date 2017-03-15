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

use Qiniu\Auth;
use Qiniu\Storage\BucketManager;
use Qiniu\Storage\UploadManager;

/**
 * FileUploadManager.
 *
 */
class FileUploadManager
{

    /**
     * ...
     *
     * @var string
     */
    private $bucket;

    /**
     * ...
     *
     * @var string
     */
    private $token;

    /**
     * ...
     *
     * @var \Qiniu\Storage\BucketManager
     */
    private $bucketManager;

    /**
     * ...
     *
     * @var \Qiniu\Storage\UploadManager
     */
    private $uploadManager;


    /**
     * FileUploadManager constructor.
     *
     * @access public
     */
    public function __construct()
    {
        $accessKey = config('filesystems.disks.qiniu.access_key');
        $secretKey = config('filesystems.disks.qiniu.secret_key');
        $this->bucket = config('filesystems.disks.qiniu.bucket');

        $auth = new Auth($accessKey, $secretKey);

        $this->token = $auth->uploadToken($this->bucket);
        $this->uploadManager = new UploadManager();
        $this->bucketManager = new BucketManager($auth);
    }


    /**
     * ...
     *
     * @param string $key
     * @param string $filePath
     *
     * @return boolean
     * @access public
     */
    public function uploadFile($key, $filePath)
    {
        list($ret, $err) = $this->uploadManager->putFile($this->token, $key, $filePath);
        if ($err !== null) {
            return false;
        }

        return true;
    }


    /**
     * ...
     *
     * @param string $key
     *
     * @return boolean
     * @access public
     */
    public function deleteFile($key)
    {
        $err = $this->bucketManager->delete($this->bucket, $key);
        if ($err !== null) {
            return false;
        }

        return true;
    }
}

/* <> */
