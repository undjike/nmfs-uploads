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

return [
    // The directory to store the uploaded files to
    'upload_dir' => public_path() . '/temps/',

    // The URL to which the upload request is sent
    // When null, the request will be sent to the current url
    // with POST method instead
    'upload_url' => null,

    // The input file name that is handling the file
    'param_name' => 'file',

    // When uploading a large file, the size of chunks in
    // which the file will be divided
    // Default : 2 Mo, corresponding to the default limit
    // of uploadable file size to PHP server
    'readfile_chunk_size' => 2 * 1024 * 1024,

    // The accepted file types
    // Default accepted files : pdf, mp4, flv, avi, mov, wmv, webm
    // For images you can use : '/\.(gif|jpe?g|png)$/i'
    'accept_file_types' => '/\.(pdf|mp4|flv|avi|mov|wmv|webm)$/i',

    // The maximum uploadable file size
    // When mull, no limit
    'max_file_size' => null,

    // The minimum uploadable file size
    // Default 1, the uploaded file cannot be lest than 1 byte
    'min_file_size' => 1,

    // The maximum number of files for the upload directory
    'max_number_of_files' => null,

    // The HTTP method to use for DELETE request
    // Set the following option to 'POST', if your
    // server does not support DELETE requests
    'delete_type' => 'DELETE',

    // CORS configurations
    'access_control_allow_origin' => '*',
    'access_control_allow_credentials' => false,

    // Methods to allow from requests
    'access_control_allow_methods' => array('OPTIONS', 'HEAD', 'GET', 'POST', 'PUT', 'PATCH', 'DELETE'),

    // Headers to allow from requests
    // NOTICE : DON'T REMOVE EXISTING ALLOWED HEADERS HERE
    // You are free to add some
    'access_control_allow_headers' => array('Content-Type', 'Content-Range', 'Content-Disposition')
];