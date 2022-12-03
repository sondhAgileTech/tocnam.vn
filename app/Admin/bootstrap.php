<?php

/**
 * Laravel-admin - admin builder based on Laravel.
 * @author z-song <https://github.com/z-song>
 *
 * Bootstraper for Admin.
 *
 * Here you can remove builtin form field:
 * Encore\Admin\Form::forget(['map', 'editor']);
 *
 * Or extend custom form field:
 * Encore\Admin\Form::extend('php', PHPEditor::class);
 *
 * Or require js and css assets:
 * Admin::css('/packages/prettydocs/css/styles.css');
 * Admin::js('/packages/prettydocs/js/main.js');
 *
 */

//Encore\Admin\Form::forget(['map', 'editor']);
//use App\Admin\Extensions\Form\CKEditor;
use App\Admin\Extensions\Form\Slugs;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;

Form::extend('ckeditor', CKEditor::class);
Form::extend('slugs', Slugs::class);
Admin::js('/vendor/laravel-admin/laravel-admin/laravel-main.js');
//

$script = <<<SCRIPT

$(document).on(function() { SetSlugs(); });
$(document).on('pjax:end',   function() { SetSlugs();  });

SCRIPT;
Admin::script($script);

