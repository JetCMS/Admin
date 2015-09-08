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

class User extends BaseController
{
	protected function display()
	{
		$display = parent::display();
		$display->with('roles');
		return $display;
	}

	protected function filter()
	{
		$roleName = Model_Role::where(['id'=>Input::get('role')])->first();
		$roleName = ($roleName) ? $roleName->name : null;

		return [			

			Filter::custom('role')->callback(function ($query, $parameter)
			{
				$query->getUserRole($parameter);
			})->title('Фильтр по роли: '. $roleName),

		];
	}

	public function column ()
	{
		return [
			Column::string('name')->label('Name'),
			Column::string('email')->label('Email'),
			Column::lists('roles.name')->label('Roles')->orderable(false),
			Column::custom()->label('active')->callback(function ($instance)
			{
				if ($instance->active)
				{
					return ' <span><i class="fa fa-chevron-down" data-toggle="tooltip" title="" data-original-title="Active"></i></span>';
				}
			})->orderable(false),
		];
	}

	public function create ()
	{
		return [
			FormItem::text('name', 'Name')->required(),
			FormItem::text('email', 'Email')->required()->unique(),
			FormItem::multiselect('roles', 'Roles')->model('App\Role')->display('name'),
			FormItem::password('set_password')->label('Password'),
			FormItem::checkbox('active')->label('Active'),
			FormItem::textarea('description', 'description'),
			FormItem::image('avatar', 'Avatar'),
		];
	}
}