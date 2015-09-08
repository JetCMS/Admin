<?php namespace JetCMS\Admin\Controller;

use Input;

use Admin;
use AdminForm;
use AdminDisplay;
use Filter;
use ColumnFilter;
use Column;
use FormItem;

use App\FormField as Model_FormField;

use JetCMS\Admin\BaseController;

class FormField extends BaseController
{
	public function getModelClass()
	{
		return Model_FormField::class;
	}

	protected function display()
	{
		$display = parent::display();
		$display->apply(function ($query)
		{
			$query->orderBy('order', 'asc');
		});
		return $display;
	}

	public function filter ()
	{
		return [
			Filter::custom('form')->callback(function ($query, $parameter)
			{
				$query->where(['form_id'=>$parameter]);
			})->title('Фильтр по форме: ')
		];
	}

	public function column ()
	{
		return [
			Column::string('name')->label('Name')->orderable(false),
			Column::string('lable')->label('lable')->orderable(false),
			Column::custom()->label('require')->callback(function ($instance)
			{
				if ($instance->require)
				{
					return ' <span><i class="fa fa-chevron-down" data-toggle="tooltip" title="" data-original-title="Active"></i></span>';
				}
			})->orderable(false),
			Column::string('order')->label('Order')->orderable(false),
			Column::order()->orderable(false),
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
					FormItem::checkbox('require')->label('Require'),
					FormItem::checkbox('active')->label('Active'),
					FormItem::select('type', 'Type')->options([1 => 'text', 2 => 'textarea', 3 => 'datatime'])->required(),
		    		FormItem::select('form_id', 'Form iD')->model('App\Form')->display('lable')->defaultValue(Input::get('form',0)),
		    		FormItem::text('order', 'order'),
		    	]
		    ])
		];
	}
}