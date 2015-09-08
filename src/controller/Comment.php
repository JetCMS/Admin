<?php namespace JetCMS\Admin\Controller;

use Input;

use Admin;
use AdminForm;
use AdminDisplay;
use Filter;
use ColumnFilter;
use Column;
use FormItem;

use App\Comment as Model_Comment;

use JetCMS\Admin\BaseController;

class Comment extends BaseController
{
	public function getModelClass()
	{
		return Model_Comment::class;
	}

	protected function display()
	{
		$display = parent::display();
		$display->with('object','user');
		return $display;
	}

	public function column ()
	{
		return [
			Column::string('lable')->label('lable'),
			Column::string('user.name')->label('User'),
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
		    		FormItem::text('lable', 'lable')->required(),
					
		    	],[
		    		FormItem::select('user_id', 'User')->model('App\User')->display('name'),
		    		FormItem::checkbox('active')->label('Active'),
		    	]

		    ]),
		    FormItem::ckeditor('content', 'Content'),
		];
	}
}