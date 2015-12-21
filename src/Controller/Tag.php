<?php namespace JetCMS\Admin\Controller;

use Input;

use Admin;
use AdminForm;
use AdminDisplay;
use Filter;
use ColumnFilter;
use Column;
use FormItem;

use JetCMS\Admin\BaseController;

class Tag extends BaseController
{
    public function init($name)
    {
        Admin::model('App\Tag')->title($name)->display(function ()
        {
            $display = AdminDisplay::table();

            $display->columns([
                Column::checkbox(),
                Column::string('lable')->label('Lable'),
                Column::string('context')->label('Context'),
            ]);
            return $display;
        })->createAndEdit(function ()
        {
            $form = AdminForm::form();
            $form->items([
                FormItem::text('lable', 'Lable')->required(),
                FormItem::text('context', 'Context'),
            ]);
            return $form;
        })->delete(null);
    }
}