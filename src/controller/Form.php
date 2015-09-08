<?php namespace JetCMS\Admin\Controller;

use Input;

use Admin;
use AdminForm;
use AdminDisplay;
use Filter;
use ColumnFilter;
use Column;
use FormItem;

use App\Form as Model_Form;

use JetCMS\Admin\BaseController;

class Form extends BaseController
{
	public function getModelClass()
	{
		return Model_Form::class;
	}

	protected function display()
	{
		$display = parent::display();
		$display->with('fields');
		return $display;
	}

	public function column ()
	{
		return [
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
		];
	}

	public function create ()
	{
		return [
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
		];
	}
}