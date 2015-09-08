<?php namespace JetCMS\Admin\Controller;

use Input;

use Admin;
use AdminForm;
use AdminDisplay;
use Filter;
use ColumnFilter;
use Column;
use FormItem;

use App\Gallery as Model_Gallery;

use JetCMS\Admin\BaseController;

class Gallery extends BaseController
{
	public function getModelClass()
	{
		return Model_Gallery::class;
	}

	protected function display()
	{
		$display = parent::display();
		$display->with('images');
		return $display;
	}

	public function column ()
	{
		return [
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
		];
	}

	public function create ()
	{
		return [
			FormItem::columns()->columns([
		    	[
		    		FormItem::text('name', 'Name')->required()->unique(),
					
		    	],[
		    		FormItem::text('lable', 'Lable'),
					FormItem::checkbox('active')->label('Active'),
		    	]

		    ]),
		    FormItem::ckeditor('content', 'Content'),
		];
	}
}