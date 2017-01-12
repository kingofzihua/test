<?php

namespace App\Admin\Extensions;

use Encore\Admin\Form\Field;

class WangEditor extends Field
{
    protected $view = 'admin.form.editor';

    protected static $css = [
        '/packages/wangEditor-2.1.22/dist/css/wangEditor.min.css',
    ];

    protected static $js = [
        '/packages/wangEditor-2.1.22/dist/js/wangEditor.min.js',
    ];

    public function render()
    {
        $this->script = <<<EOT

            var editor = new wangEditor('{$this->id}');
            // 上传图片（举例）
            editor.config.uploadImgUrl = '/api/upload';

            //上传文件的name
            editor.config.uploadImgFileName = 'editor'

            // 配置自定义参数（举例）
            editor.config.uploadParams = {
                token: 'abcdefg',
                user: 'wangfupeng1988'
            };
        
            // 设置 headers（举例）
//            editor.config.uploadHeaders = {
//                'Accept' : 'text/x-json'
//            };
        
            // 隐藏掉插入网络图片功能。该配置，只有在你正确配置了图片上传功能之后才可用。
            editor.config.hideLinkImg = true;

            editor.create();

EOT;
        return parent::render();

    }
}