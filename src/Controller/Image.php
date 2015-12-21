<?php namespace JetCMS\Admin\Controller;

use Input;

use Admin;
use AdminForm;
use AdminDisplay;
use Filter;
use ColumnFilter;
use Column;
use FormItem;

use App\Image as Model_Image;

use JetCMS\Admin\BaseController;

class Image extends BaseController
{
	public function getModelClass()
	{
		return Model_Image::class;
	}

	protected function display()
	{
		$display = parent::display();
		$display->with('gallery');
		return $display;
	}

	protected function filters ()
	{
		return [
			Filter::custom('gallery')->callback(function ($query, $parameter)
			{
				$query->where(['gallery_id'=>$parameter]);
			})->title('Фильтр по голереи: '),
		];
	}

	public function column ()
	{
		return [
			Column::checkbox(),
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
		];
	}

	public function create ()
	{
		return [
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
		];
	}
}