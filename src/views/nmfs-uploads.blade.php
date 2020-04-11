<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Files upload">
        <meta name="author" content="Ulrich Pascal Ndjike Zoa">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Active Page Title | Site Title -->
        <title>{{ __('Uploads') }}</title>

        <!-- Styles -->
        <link href="{{ asset('vendor/nmfs-uploads/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('vendor/nmfs-uploads/style.css') }}" rel="stylesheet">

        <!-- Icons -->
        <link href="{{ asset('vendor/nmfs-uploads/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="wrapper">
            <div id="content-wrapper">
                <div class="container-fluid pb-5">
                    <div class="row px-5 mx-5">
                        <div class="col-md-8 mx-auto text-center upload-video pt-5 pb-5">
                            <div id="dropzone" class="fileinput-dropzone py-5">
                                <h1><i class="fas fa-file-upload text-muted" style="font-size: 150px"></i></h1>
                                <h4 class="my-4 mx-5"><span>{{ __('Drop files here or click to select files to upload.') }}</span></h4> <!-- The file input field used as target for the file upload widget -->
                                <p class="land">{{ __('.mp4, .avi, .flv, .mov, .wmv, .webm ou .pdf') }}</p>
                                <input id="fileupload-dropzone" type="file" name="file" accept="application/pdf,video/*" multiple>
                            </div>
                        </div>

                        <div class="col-md-8 mx-auto">
                            <div class="progression">
                                <div class="progress" id="progress">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-info" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                            </div>
                            <div class="mt-5 text-muted text-center">{{ __('Please, stay on this page till all your files are uploaded.') }}</div>
                            <div id="uploadList" class="list-group list-group-divider mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="{{ asset('vendor/nmfs-uploads/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('vendor/nmfs-uploads/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!--suppress VueDuplicateTag -->
        <script>
            $(document).ready(function () {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
            });
        </script>

        <script src="{{  asset('vendor/nmfs-uploads/blueimp-file-upload/js/vendor/jquery.ui.widget.min.js') }}"></script>
        <script src="{{  asset('vendor/nmfs-uploads/blueimp-load-image/load-image.all.min.js') }}"></script>
        <script src="{{  asset('vendor/nmfs-uploads/blueimp-canvas-to-blob/canvas-to-blob.min.js') }}"></script>
        <script src="{{  asset('vendor/nmfs-uploads/blueimp-file-upload/js/jquery.iframe-transport.min.js') }}"></script>
        <script src="{{  asset('vendor/nmfs-uploads/blueimp-file-upload/js/jquery.fileupload.min.js') }}"></script>
        <script src="{{  asset('vendor/nmfs-uploads/blueimp-file-upload/js/jquery.fileupload-process.min.js') }}"></script>
        <script src="{{  asset('vendor/nmfs-uploads/blueimp-file-upload/js/jquery.fileupload-image.min.js') }}"></script>
        <script src="{{  asset('vendor/nmfs-uploads/blueimp-file-upload/js/jquery.fileupload-audio.min.js') }}"></script>
        <script src="{{  asset('vendor/nmfs-uploads/blueimp-file-upload/js/jquery.fileupload-video.min.js') }}"></script>
        <script src="{{  asset('vendor/nmfs-uploads/blueimp-file-upload/js/jquery.fileupload-validate.min.js') }}"></script>
        <script src="{{  asset('vendor/nmfs-uploads/nmfs-client.js') }}"></script>
    </body>
</html>

