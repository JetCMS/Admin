<?php

/*
 * This is a simple example of the main features.
 * For full list see documentation.
 */

/*
if (!App\Menu::isValidNestedSet())
{
	App\Menu::rebuild();
}
*/

Admin::model(App\Role::class)->title('Roles')->display(function ()
{
	$display = AdminDisplay::datatablesAsync();
	$display->with('users');
	$display->columns([
		Column::string('name')->label('Name'),
		Column::custom()->label('Users')->callback(function ($instance)
		{
		    return sizeof($instance->users).
		    ' <a href="/'.config('admin.prefix').'/users?role='.$instance->id.'"><i class="fa fa-arrow-circle-o-right" data-toggle="tooltip" title="" data-original-title="Show"></i></a>';
		})->orderable(false),
	]);
	return $display;
})->createAndEdit(function ()
{
	$form = AdminForm::form();
	$form->items([
		FormItem::text('name', 'Name')->required(),
		FormItem::multiselect('users', 'Users')->model('App\User')->display('name'),
	]);
	return $form;
});

Admin::model(App\Menu::class)->title('Menus')->display(function ()
{

	$display = AdminDisplay::tree();
	$display->value('lable');
	return $display;
})->createAndEdit(function ()
{
	$form = AdminForm::form();
	$form->items([
		FormItem::text('lable', 'Lable')->required(),
		FormItem::text('url')->label('URL'),
		FormItem::text('name')->label('Name'),		
		FormItem::text('accesskey')->label('Accesskey'),
		FormItem::text('tabindex')->label('Tabindex'),
		FormItem::checkbox('active')->label('Active'),
	]);
	return $form;
});



//dump(App\Menu::getNestedList('lable'));
/*
Admin::model(SleepingOwl\AdminAuth\Entities\Administrator::class)->title('Administrator')->display(function ()
{
	$display = AdminDisplay::table();
	$display->columns([
		Column::string('username')->label('username'),
		Column::string('name')->label('name'),
	]);
	return $display;
})->create(function ()
{
	$form = AdminForm::form();
	$form->items([
		FormItem::text('username', 'username')->required(),
		FormItem::text('name', 'name')->required()->unique(),
		FormItem::password('password', 'password')->required()->unique(),
	]);
	return $form;
})->edit(function ()
{


	$display = AdminDisplay::tabbed();
	    
	return $display->tabs(function ()
	{
		$tabs = [];

		$firstTab = AdminDisplay::table(App\User::class);
		$firstTab->columns([
			Column::string('username')->label('username'),
			Column::string('name')->label('name'),
		]);
		$tabs[] = AdminDisplay::tab($firstTab)->label('First Tab')->active(true);

		$secondTab = AdminForm::form();
		$secondTab->items([
			FormItem::text('username', 'username')->required(),
			FormItem::text('name', 'name')->required()->unique(),
			FormItem::password('password', 'password'),
		]);
		$tabs[] = AdminDisplay::tab($secondTab)->label('Second Tab');

		return $tabs;
	});
	
});

*/