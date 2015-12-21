<?php namespace JetCMS\Admin\Controller;

use Input;

use Admin;
use AdminForm;
use AdminDisplay;
use Filter;
use ColumnFilter;
use Column;
use FormItem;

use App\Menu as Model_Menu;

use JetCMS\Admin\BaseController;

class Menu extends BaseController
{
	public function getModelClass()
	{
		return Model_Menu::class;
	}

	protected function display()
	{
		$display = AdminDisplay::tree();
		$display->value('lable');
		return $display;
	}

	public function column ()
	{
		return [];
	}

	public function create ()
	{
		return [
			FormItem::text('lable', 'Lable')->required(),
			FormItem::text('url')->label('URL'),
			FormItem::text('name')->label('Name'),		
			FormItem::text('accesskey')->label('Accesskey'),
			FormItem::text('tabindex')->label('Tabindex'),
			FormItem::checkbox('active')->label('Active'),
		];
	}
}