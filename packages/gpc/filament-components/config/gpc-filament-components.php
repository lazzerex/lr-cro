<?php

return [
    'file-manager' => [
        'picker-url' => '/admin/file-manager/fm-button',
        'tinymce-url' => '/admin/file-manager/tinymce5',
    ],
    'tinymce' => [
        'maxHeight' => 800,
        'minHeight' => 500,

        'profiles' => [

            'default' => [
                'plugins' => 'advlist anchor autoresize code codesample emoticons fullscreen image insertdatetime link lists media quickbars table wordcount',

                'toolbar' => 'blocks bold italic forecolor backcolor removeformat | align numlist bullist | table image link unlink anchor media | emoticons insertdatetime | fullscreen code undo redo',

                'upload_directory' => null,

                'custom_configs' => [
                ],
            ],

            'simple' => [
                'plugins' => 'advlist autoresize code emoticons image insertdatetime link lists table',
                'toolbar' => 'blocks bold italic forecolor removeformat | align numlist bullist | table image link unlink | emoticons insertdatetime',
                'upload_directory' => null,
            ],
        ],

        /*
        |--------------------------------------------------------------------------
        | Templates
        |--------------------------------------------------------------------------
        |
        | You can add as many as you want of templates to use it in your application.
        |
        | https://www.tiny.cloud/docs/plugins/opensource/template/#templates
        |
        | ex: TinyEditor::make('content')->profiles('template')->template('example')
        */

        'templates' => [

            'example' => [
                // content
                ['title' => 'Some title 1', 'description' => 'Some desc 1', 'content' => 'My content'],
                // url
                ['title' => 'Some title 2', 'description' => 'Some desc 2', 'url' => 'http://localhost'],
            ],
        ],
    ]
];