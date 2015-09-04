<?php

Admin::model(App\Gallery::class)->title('Gallery')->display(function ()
{
	$display = AdminDisplay::datatablesAsync();
	$display->with('images');

	$display->columns([
		Column::string('name')->label('Name'),
		Column::string('lable')->label('lable'),
		Column::custom()->label('Images')->callback(function ($instance)
		{
		    return sizeof($instance->images).
		    ' <a href="/'.config('admin.prefix').'/gallery_images?gallery='.$instance->id.'"><i class="fa fa-arrow-circle-o-right" data-toggle="tooltip" title="" data-original-title="Show"></i></a>';
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
				
	    	],[
	    		FormItem::text('lable', 'Lable'),
				FormItem::checkbox('active')->label('Active'),
	    	]

	    ]),
	    FormItem::ckeditor('content', 'Content'),		

		//FormItem::options('gallety', 'Gallery')->model('App\Gallery')->display('name'),
	]);
	return $form;

});

Admin::model(App\GalleryImage::class)->title('Images')->display(function ()
{
	$display = AdminDisplay::datatablesAsync();

	$display->filters([
		
		Filter::custom('gallery')->callback(function ($query, $parameter)
		{
			$query->where(['gallery_id'=>$parameter]);
		})->title('Фильтр по голереи: ')
		
	]);

	$display->with('gallery');
	$display->columns([
		Column::image('image')->label('Image'),
		Column::string('lable')->label('lable'),
		Column::custom()->label('gallery')->callback(function ($instance)
		{
			if ($instance->gallery)
			{
				return $instance->gallery->name;
			}
		})->orderable(false),	
		Column::string('url')->label('Url'),
	]);
	return $display;
})->createAndEdit(function ()
{

	$form = AdminForm::form();
	$form->items([

		FormItem::columns()->columns([
	    	[
	    		FormItem::text('lable', 'Lable')->required(),
	    		FormItem::text('url', 'Url'),
	    		FormItem::select('gallery_id', 'Gallery')->model('App\Gallery')->display('name')->defaultValue(Input::get('gallery',0)),
				
	    	],[
	    		FormItem::image('image', 'Image'),
	    	]
	    ]),
	    FormItem::textarea('description', 'description')
	]);
	return $form;


});