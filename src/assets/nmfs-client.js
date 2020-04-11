
/*
 * *
 *  * # nmfs-uploads
 *  *
 *  * @author    Ulrich Pascal Ndjike Zoa <ndjikezoaulrich@gmail.com>
 *  * @copyright 2020 Ulrich Pascal Ndjike Zoa / RYS Studio
 *  * @license   http://www.opensource.org/licenses/mit-license.php MIT
 *  * @link      https://github.com/undjike/nmfs-uploads
 *
 */

"use strict";

$(function () {
    // Change this to the location of your server-side upload handler.
    const url = undefined;

    const uploadButton = $('<button/>').addClass('btn btn-sm btn-secondary').prop('disabled', true).text('Processing...').on('click', function () {
        const $this = $(this);
        const data = $this.data();
        $this.off('click').text('Abort').on('click', function () {
            data.abort();
        });
        data.submit().always(function () {
            $('#progress').removeClass('show').children().css('width', 0);
        });
    });
    const removeButton = $('<button/>').addClass('btn btn-sm btn-secondary').html('<i class="far fa-trash-alt"></i>').on('click', function () {
        $(this).parents('.list-group-item').remove();
    });
    const doneButton = $('<button/>').addClass('btn btn-sm btn-secondary').text('Done').on('click', function () {
        $(this).parents('.list-group-item').fadeOut();
    });
    $('#fileupload-customInput, #fileupload-btn, #fileupload-dropzone').fileupload({

        // A string containing the URL to which the request is sent.
        url: url,

        // The drop target jQuery object, by default the complete document.
        // Set to null or an empty jQuery collection to disable drag & drop support
        dropZone: null,

        // The type of data that is expected back from the server.
        // A response of this type is considered as a success upload
        dataType: 'json',

        // If true, selected file are immediately uploaded to server
        autoUpload: false,

        // To upload large files in smaller chunks, set this option
        // to a preferred maximum chunk size. If set to 0, null or
        // undefined, or the browser does not support the required
        // Blob API, files will be uploaded as a whole.
        // Default : 2 Mo which is the default limit for PHP server
        maxChunkSize: 2 * 1024 * 1024,

        // Max file size to allow from client
        // maxFileSize: 550 * 1024 * 1024, //550 Mo

        // Enable image resizing, except for Android and Opera,
        // which actually support image resizing, but fail to
        // send Blob objects via XHR requests:
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),

        // Width of the preview when image selected
        previewMaxWidth: 32,

        // Height of the preview when image selected
        previewMaxHeight: 32,

        // Define if preview images should be cropped or only scaled.
        previewCrop: true
    }).on('fileuploadadd', function (e, data) {
        data.context = $('<div/>').addClass('list-group-item').prependTo('#uploadList');
        $.each(data.files, function (index, file) {
            const fileName = $('<div/>').addClass('media-body').text(file.name);
            const media = $('<div/>').addClass('media align-items-center').append(fileName);
            const node = $('<div/>').addClass('list-group-item-body').append(media);

            if (!index) {
                const mediaAction = $('<div/>').addClass('media-actions').append(uploadButton.clone(true).data(data));
                node.find('.media').append(mediaAction);
            }

            node.prependTo(data.context);
        });
    }).on('fileuploadprocessalways', function (e, data) {
        const index = data.index;
        const file = data.files[index];
        const node = $(data.context.children()[index]);
        let figure, figPreview;

        if (data.files[0].type.includes('video'))
            figure = $('<div />').addClass('tile bg-muted').html('<i class="fas fa-video"></i>');
        else
        {
            if (file.preview) {
                figure = $('<div/>').addClass('tile tile-img').append(file.preview);
            } else {
                figure = $('<div />').addClass('tile bg-danger').text('NA');
            }
        }

        figPreview = $('<div/>').addClass('list-group-item-figure').append(figure);
        data.context.prepend(figPreview);

        if (index + 1 === data.files.length) {
            // noinspection JSCheckFunctionSignatures
            data.context.find('button').text('Upload').prop('disabled', !!data.files.error);
        }

        if (file.error) {
            node.append($('<p class="list-group-item-text text-red"/>').text(file.error));
            node.next().html(removeButton.clone(true));
        }
    }).on('fileuploadprogressall', function (e, data) {
        // noinspection JSCheckFunctionSignatures
        const progress = parseInt(data.loaded / data.total * 100, 10);
        $('#progress').addClass('show').children().css('width', progress + '%');
    }).on('fileuploaddone', function (e, data) {
        // noinspection JSUnresolvedVariable
        if (data.result.file[0].error) {
            const error = $('<p class="list-group-item-text text-red"/>').text(data.result.file[0].error);
            // noinspection JSCheckFunctionSignatures
            data.context.find('.media-body').append(error);
            // noinspection JSCheckFunctionSignatures
            data.context.find('.media-actions').html(removeButton.clone(true));
        } else if (data.result.file) {
            // noinspection JSCheckFunctionSignatures
            data.context.find('.media-actions').html(doneButton.clone(true));
        }
    }).on('fileuploadfail', function (e, data) {
        // noinspection JSUnusedLocalSymbols
        $.each(data.files, function (index) {
            const error = $('<p class="list-group-item-text text-red"/>').text('File upload failed.');
            $(data.context).find('.media-body').append(error);
            // noinspection JSCheckFunctionSignatures
            data.context.find('.media-actions').html(removeButton.clone(true));
        });
    }).prop('disabled', !$.support.fileInput).parent().addClass($.support.fileInput ? undefined : 'disabled');

    // =============================================================
    // Upload with dropzone
    // =============================================================

    const dropZone = $('#dropzone');
    $('#fileupload-dropzone').fileupload('option', 'dropZone', dropZone);
    dropZone.on('dragover', function () {
        dropZone.addClass('hover');
    }).on('drop dragleave', function () {
        dropZone.removeClass('hover');
    });
});