# Nmfs-uploads (No Matter File Size Uploads to your PHP server)

<p align="center">
<a href="https://github.com/undjike/nmfs-uploads/issues"><img src="https://img.shields.io/github/issues/undjike/nmfs-uploads" alt="Issues"></a>
<a href="https://github.com/undjike/nmfs-uploads"><img src="https://img.shields.io/github/stars/undjike/nmfs-uploads?color=purple" alt="Stars"></a>
<a href="https://github.com/undjike/nmfs-uploads"><img src="https://poser.pugx.org/undjike/nmfs-uploads/downloads" alt="Total Downloads"></a>
<a href="https://github.com/undjike/nmfs-uploads"><img src="https://poser.pugx.org/undjike/nmfs-uploads/license" alt="License"></a>
</p>

## Introduction

Nmfs-uploads package allows you to perform uploads of no matter file size to your PHP server.

You certainly know that the default PHP server's configuration limits the size of files upload to 2 Mb maximum.
With this package, you need not to change the default configuration in your php.ini or other.

Nmfs-uploads package provides you with some tools and implements chunk uploads. This means that whatever size the file to upload is, the server will chunk the file in small parts of size under 2 Mb and automatically will merge the parts at the end.

## Installation

Require this package with composer using the following command:

```bash
composer require undjike/nmfs-uploads
```

After updating composer, add the service provider to the `providers` array in `config/app.php` if you are using a Laravel version under 5.5.

```php
Undjike\NmfsUploads\NmfsUploadsServiceProvider::class
```
**Laravel 5.5** or later version uses Package Auto-Discovery, so doesn't require you to manually add the ServiceProvider.

After installing the package via composer, you will need to publish the configurations of the package. Use the following artisan command:

```php
php artisan vendor:publish Undjike\NmfsUploads\NmfsUploadsServiceProvider
```

This will publish all the necessaries for the package to work and some files to demonstrate how to use this package.

Now, you can just visit your server page at `/uploads` (with your Laravel Development Server : `localhost:8000/uploads`) to have a demonstration of how this stuff works.

## Usage

Configuration publication will generate for you:

* A configuration file in the config directory of your project, `config/nmfs-uploads.php`.

```php
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
    'max_file_size' => 550 * 1024 * 1024, //550 Mb

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
```

* A sample controller `app/Http/Controllers/NmfsUploadsController.php` with two methods `index` and `perform`.

```php
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

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Undjike\NmfsUploads\Uploader;

class NmfsUploadsController extends Controller
{
    /**
     * Show the upload page
     *
     * @return Factory|View
     */
    public function index()
    {
        return view('nmfs-uploads');
    }

    /**
     * Perform file upload
     *
     * @return void
     */
    public function perform()
    {
        Uploader::receive(function ($response) {
            // TODO: Perform some actions on upload done
        });
    }
}
```

* A view `resources/views/nmfs-uploads.blade.php` that is a sample page to perform your uploads.

The view uses a dropzone for you to just drag and drop your files for them to be uploaded to your server.
As seen in the extract above, the `index` method of the controller simply return this view.

* As you may have guessed, two `routes` are added to your `web.php`. 

The first, named `upload` with a `GET` method used for displaying the upload page and the second with a `POST`, to which upload requests will be sent. 

```php
// Routes generated for demonstration uses of nmfs-uploads package
// Feel free to delete them when you are done

Route::get('uploads', 'NmfsUploadsController@index')->name('upload');
Route::post('uploads', 'NmfsUploadsController@perform')->name('perform.upload');
```

* Finally, the package provides some assets in `public/vendor/nmfs-uploads`.

 <pre><code>
 your-project/
 └───public/
     └───vendor/
         └───nmfs-uploads/
             └───blueimp-canvas-to-blob/
             └───blueimp-file-upload/
             └───blueimp-load-image/
             └───blueimp-tmpl/
             └───bootstrap/
             └───fontawesome-free/
             └───jquery/
             └───nmfs-client.js
             └───style.css
 </code></pre>

Most of these assets are used for beautifully rendering your upload page.

We needed to provide `bootstrap` and `jQuery` to ensure it will be available for the package. If you already got it, feel free to delete these directories and replace the links in the upload view.

All of `blueimp` directories are used to perform the main stuff of the package. If you need to know more about the package, browse to <a href="https://github.com/blueimp/jQuery-File-Upload">blueimp</a>.

## Understanding

The `recieve` closure in the `perform` method of the controller allow you to perform some actions after an upload is successfully done.
By default, uploads are stored in a public directory `temps`. You are free to change this. The name `temps` is only given because it's usual to get an upload there an to move it in a self-made library. Personally, we did this several times with <a href="https://docs.spatie.be/laravel-medialibrary/v7/introduction/">spatie/laravel-medialibrary</a>.

Surely, you must have realized that urls in configuration files are set to `null` by default. This is done on purpose.
To allow you to take a very light use of the package, when upload url is set to `null`, the package uses the current url to post the upload.

This can be very useful when using multiple upload pages. Meaningfully, the url to display the upload page is the same to which the file will be posted.

```php
    // The URL to which the upload request is sent
    // When null, the request will be sent to the current url
    // with POST method instead
    'upload_url' => null,
```

You should be aware that the client side of the package is made in jQuery, so if you are not satisfied by the page design or you want to customize some aspects, edit `public/vendor/nmfs-uploads/nmfs-client.js`.

#### Note

Some of the configurations and restrictions clauses can be declare in both client and server side. It may be useful when working with multiple clients with different access level.

For any question or issue with this package, extend me a message and it will be a pleasure to solve the problem.

## License

Nmfs-uploads is distributed under **MIT license**.
