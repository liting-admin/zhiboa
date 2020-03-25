<?php

namespace App\Admin\Controllers;

use App\Reg;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class RegController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '注册';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Reg());

        $grid->column('id', __('Id'));
        $grid->column('uname', __('Uname'));
        $grid->column('pwd', __('Pwd'));
        $grid->column('phone', __('Phone'));

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Reg::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('uname', __('Uname'));
        $show->field('pwd', __('Pwd'));
        $show->filed('phone', __('Phone'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Reg());

        $form->text('uname', __('Uname'));
        $form->password('pwd', __('Pwd'));
        $form->text('phone', __('phone'));
        return $form;
    }
}
