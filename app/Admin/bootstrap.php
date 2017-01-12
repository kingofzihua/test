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
use Encore\Admin\Form;

//移除map标签
Form::forget('map');
Form::forget('editor');

//集成富文本编辑器wangEditor
use App\Admin\Extensions\WangEditor;

Form::extend('wangEditor', WangEditor::class);

//扩展一个基于codemirror的PHP代码编辑器
use App\Admin\Extensions\PHPEditor;

Form::extend('PHPEditor', PHPEditor::class);