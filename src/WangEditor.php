<?php
/**
 * @Author       : fanjinghua
 * @LastEditors  : fanjinghua
 * @LastEditTime : 2022/1/10 16:22
 * @Description  : 佛祖保佑,永无BUG
 */

namespace PandaOreo\WangEditor;

use Dcat\Admin\Admin;
use Dcat\Admin\Form\Field;

class WangEditor extends Field
{
    protected $view = 'wang-editor::index';

    public function render()
    {
        Admin::js('vendor/dcat-admin-extensions/panda-oreo/wang-editor/js/wangEditor.min.js');
        return parent::render(); // TODO: Change the autogenerated stub
    }
}
