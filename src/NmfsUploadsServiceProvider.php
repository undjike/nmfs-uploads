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

use Illuminate\Support\ServiceProvider;

class NmfsUploadsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if (!file_exists(config_path('nmfs-uploads.php')))
        {
            file_put_contents(
                base_path('routes/web.php'),
                file_get_contents(__DIR__. '/routes/web.stub'),
                FILE_APPEND
            );
        }

        $this->mergeConfigFrom(__DIR__ . '/config/nmfs-uploads.php', 'nmfs-uploads');

        $this->publishes([
            __DIR__ . '/assets' => public_path('vendor/nmfs-uploads')
        ]);

        $this->publishes([
            __DIR__ . '/config/nmfs-uploads.php' => config_path('nmfs-uploads.php')
        ]);

        $this->publishes([
            __DIR__ . '/views/nmfs-uploads.blade.php' => resource_path('views/nmfs-uploads.blade.php')
        ]);

        $this->publishes([
            __DIR__ . '/controllers/NmfsUploadsController.stub' => app_path('Http/Controllers/NmfsUploadsController.php')
        ]);
    }

    public function register()
    {

    }
}