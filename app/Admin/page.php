<?php 

Admin::model(App\Page::class)->title('Pages')->display(function ()
{
	$display = AdminDisplay::datatablesAsync();
	$display->with('accessPages','menu');

	$display->columns([
		Column::image('image')->label('Image'),
		Column::string('title')->label('Title'),
		Column::string('alias')->label('Alias'),
		Column::lists('accessPages.name')->label('Access')->orderable(false),

		Column::custom()->label('Page Fields')->callback(function ($instance)
		{
		    return sizeof($instance->pagefield).
		    ' <a href="/'.config('admin.prefix').'/page_fields?page='.$instance->id.'"><i class="fa fa-arrow-circle-o-right" data-toggle="tooltip" title="" data-original-title="Show"></i></a>';
		})->orderable(false),

		Column::custom()->label('menu')->callback(function ($instance)
		{
			if ($instance->menu)
			{
				if ($instance->menu->lable != $instance->title)
				{
					$title = '<span style="color:red">'.$instance->menu->lable.'</span>';
				}
				else
				{
					$title = $instance->menu->lable;
				}

				if (substr($instance->menu->url,1) == $instance->alias)
				{
					$alias = $instance->menu->url;
				}
				else
				{
					$alias = '<span style="color:red">'.$instance->menu->url.'</span>';
				}
				$botton = ' <a href="/'.config('admin.prefix').'/menus/'.$instance->menu->id.'/edit"><i class="fa fa-edit" data-toggle="tooltip" title="" data-original-title="Active"></i></a>';

				return $title.'<br>'.$alias.'<br>'.$botton;
			}
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

	$templateOptions = [];
	foreach (config('jetcms.page_template') as $key => $val) {
		$templateOptions[$key] = $val['label'].' | '.$key;
	}

	$form->items([

		FormItem::columns()->columns([
	       	[
				FormItem::text('title', 'Title')->required(),
				FormItem::text('alias', 'Alias'),
				FormItem::textarea('description', 'Description'),
			],[
				FormItem::jSelect('menu_id', 'Menu id')->options(App\Menu::getNestedList('level_lable'))->nullable(),
				FormItem::multiselect('accessPages', 'Access')->model('App\Role')->display('name'),

				FormItem::select('template', 'Template')->options($templateOptions),

				FormItem::timestamp('publish', 'Publish')->defaultValue(Carbon::now()),
				FormItem::checkbox('active')->label('Active'),

				FormItem::jBottonLink()->url('page_fields?page=:id')->label('Дополнительные поля')->labelNonObject('Требуется сохранить объект')
			],
		]),

		FormItem::ckeditor('content', 'Content'),
		FormItem::image('image', 'Image'),
	]);
	return $form;
});




