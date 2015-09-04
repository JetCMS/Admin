<?php
Admin::model(App\Comment::class)->title('Comments')->display(function ()
{
	$display = AdminDisplay::datatablesAsync();
	$display->with('object','user');

	$display->columns([
		Column::string('lable')->label('lable'),
		Column::string('user.name')->label('User'),
		Column::custom()->label('active')->callback(function ($instance)
		{
			if ($instance->active)
			{
				return ' <span><i class="fa fa-chevron-down" data-toggle="tooltip" title="" data-original-title="Active"></i></span>';
			}
		})->orderable(false),
	]);
	return $display;
})->createAndEdit(function ()
{

	$form = AdminForm::form();
	$form->items([

		FormItem::columns()->columns([
	    	[
	    		FormItem::text('lable', 'lable')->required(),
				
	    	],[
	    		FormItem::select('user_id', 'User')->model('App\User')->display('name'),
	    		FormItem::checkbox('active')->label('Active'),
	    	]

	    ]),
	    FormItem::ckeditor('content', 'Content'),
	]);
	return $form;

});