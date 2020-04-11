<?php

/**
 * *
 *  * # nmfs-uploads
 *  *
 *  * @author    Ulrich Pascal Ndjike Zoa <ndjikezoaulrich@gmail.com>
 *  * @copyright 2020 Ulrich Pascal Ndjike Zoa / RYS Studio
 *  * @license   http://www.opensource.org/licenses/mit-license.php MIT
 *  * @link      https://github.com/undjike/nmfs-uploads
 *
 */

namespace Undjike\NmfsUploads;

use Illuminate\Support\Facades\Request;

class Uploader
{
    static function receive(callable $onUploadDone)
    {
        $uploader = new UploadHandler();

        if (isset(Request::header()['content-range'])) {
            $utils = str_replace(['-', ' '], '/', Request::header()['content-range'][0]);
            list($type, $startSize, $chunkSize, $fileSize) = explode('/', $utils);

            $percent = 100 * ($chunkSize + 1) / $fileSize;
        }
        else $percent = null;

        if ($percent == 100 || (!isset($percent) && !isset($type) && !isset($startSize)))
            $onUploadDone($uploader->get_response()[config('nmfs-uploads.param_name')][0]);
    }
}