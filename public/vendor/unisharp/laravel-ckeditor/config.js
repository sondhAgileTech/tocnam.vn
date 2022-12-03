/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.extraPlugins = 'uploadimage,image2';
    config.filebrowserImageBrowseUrl = '/admin/laravel-filemanager?type=Images';
    config.filebrowserImageUploadUrl = '/admin/laravel-filemanager/upload?type=Images';
    config.filebrowserBrowseUrl = '/admin/laravel-filemanager?type=Files';
    config.filebrowserUploadUrl = '/admin/laravel-filemanager/upload?type=Files';
    config.extraPlugins = 'wordcount';
        config.wordcount = {

        // Whether or not you want to show the Word Count
        showWordCount: true,

        // Whether or not you want to show the Char Count
        showCharCount: false,

        // Maximum allowed Word Count
       // maxWordCount: 300,

        // Maximum allowed Char Count
       // maxCharCount: 10000
    };
};
