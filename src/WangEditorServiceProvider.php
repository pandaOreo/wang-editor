<?php

/**
 * @Author       : Jinghua Fan
 * @Date         : 2022-01-08 09:23:05
 * @LastEditors  : Jinghua Fan
 * @LastEditTime : 2022-01-08 16:52:02
 * @Description  : 佛祖保佑,永无BUG
 */

namespace PandaOreo\WangEditor;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Admin;
use Dcat\Admin\Form;

class WangEditorServiceProvider extends ServiceProvider
{
    protected $js = [];
    protected $css = [];

//    protected $menu = [
//        [
//            'title' => '编辑器',
//            'uri' => 'wang-editor',
//            'icon' => '', // 图标可以留空
//        ],
//    ];

    public function register()
    {
        //
    }

    public function init()
    {
        parent::init();

        if ( $views = $this->getViewPath() ) {
            $this->loadViewsFrom($views, 'wang-editor');
        }

        Admin::booting(function () {
            Form::extend('wangEditor', WangEditor::class);
        });

    }

    public function settingForm()
    {
        return new Setting($this);
    }
}
