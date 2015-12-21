<?php namespace JetCMS\Admin\Controller;

use Input;

use Admin;
use AdminForm;
use AdminDisplay;
use Filter;
use ColumnFilter;
use Column;
use FormItem;

use App\Role as Model_Role;

use JetCMS\Admin\BaseController;

class Role extends BaseController
{
	public function getModelClass()
	{
		return Model_Role::class;
	}

	protected function display()
	{
		$display = parent::display();
		$display->with('users');
		return $display;
	}

	public function column ()
	{
		return [
			Column::checkbox(),
			Column::string('name')->label('Name'),
			Column::custom()->label('Users')->callback(function ($instance)
			{
			    return sizeof($instance->users).
			    ' <a href="/'.config('admin.prefix').'/users?role='.$instance->id.'"><i class="fa fa-arrow-circle-o-right" data-toggle="tooltip" title="" data-original-title="Show"></i></a>';
			})->orderable(false),
		];
	}

	public function create ()
	{
		return [
			FormItem::text('name', 'Name')->required(),
			FormItem::multiselect('users', 'Users')->model('App\User')->display('name'),
		];
	}
}