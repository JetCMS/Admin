<?php

Admin::model(App\Form::class)->title('Form')->display(function ()
{
	$display = AdminDisplay::datatablesAsync();
	$display->with('fields');

	$display->columns([
		Column::string('name')->label('Name'),
		Column::string('lable')->label('lable'),

		Column::custom()->label('fields')->callback(function ($instance)
		{
		    return sizeof($instance->fields).
		    ' <a href="/'.config('admin.prefix').'/form_fields?form='.$instance->id.'"><i class="fa fa-arrow-circle-o-right" data-toggle="tooltip" title="" data-original-title="Show"></i></a>';
		})->orderable(false),

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
	    		FormItem::text('name', 'Name')->required()->unique(),
	    		FormItem::text('lable', 'Lable'),
	    		FormItem::textarea('description', 'Description'),
				
	    	],[
	    		FormItem::text('url', 'Url'),
				FormItem::checkbox('active')->label('Active'),
	    	]

	    ]),
	    FormItem::text('title_message', 'Title_message'),
	    FormItem::ckeditor('message', 'Message'),		

		//FormItem::options('gallety', 'Gallery')->model('App\Gallery')->display('name'),
	]);
	return $form;

});

Admin::model(App\FormField::class)->title('Form Fields')->display(function ()
{
	$display = AdminDisplay::datatablesAsync();

	$display->apply(function ($query)
	{
		$query->orderBy('sort', 'asc');
	});

	$display->filters([
		
		Filter::custom('form')->callback(function ($query, $parameter)
		{
			$query->where(['form_id'=>$parameter]);
		})->title('Фильтр по форме: ')
		
	]);

	$display->columns([
		Column::string('name')->label('Name')->orderable(false),
		Column::string('lable')->label('lable')->orderable(false),
		Column::custom()->label('require')->callback(function ($instance)
		{
			if ($instance->require)
			{
				return ' <span><i class="fa fa-chevron-down" data-toggle="tooltip" title="" data-original-title="Active"></i></span>';
			}
		})->orderable(false),
		Column::string('sort')->label('Sort')->orderable(false),
		Column::order()->orderable(false),
	]);
	return $display;
})->createAndEdit(function ()
{

	$form = AdminForm::form();
	$form->items([

		FormItem::columns()->columns([
	    	[
	    		FormItem::text('name', 'Name')->required()->unique(),
	    		FormItem::text('lable', 'Lable'),
	    		FormItem::textarea('description', 'Description'),
				
	    	],[
				FormItem::checkbox('require')->label('Require'),
				FormItem::checkbox('active')->label('Active'),
				FormItem::select('type', 'Type')->options([1 => 'text', 2 => 'textarea', 3 => 'datatime'])->required(),
	    		FormItem::select('form_id', 'Form iD')->model('App\Form')->display('lable')->defaultValue(Input::get('form',0)),
	    		FormItem::text('sort', 'sort'),
	    	]	

	    ]),

		//FormItem::options('gallety', 'Gallery')->model('App\Gallery')->display('name'),
	]);
	return $form;

});