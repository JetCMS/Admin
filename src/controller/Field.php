<?php namespace JetCMS\Admin\Controller;

use Input;

use Admin;
use AdminForm;
use Filter;
use ColumnFilter;
use Column;
use FormItem;

use App\Page as Model_Page;
use App\Field as Model_Field;

use JetCMS\Admin\BaseController;

class Field extends BaseController
{
	public function getModelClass()
	{
		return Model_Field::class;
	}

	protected function queryModel()
	{
		return Model_Field::where(['id'=>$this->modelId])->with('page');
	}

	public function init($name)
	{
		$thisInitModel = $this;

		Admin::model(Model_Field::class)->title($name)->display(function () use ($thisInitModel)
		{

			$display = $this->display();

			$display->filters($thisInitModel->filters());
			$display->columnFilters($thisInitModel->columnFilters());			
			$display->columns($thisInitModel->column());

			return $display;
		})->createAndEdit(function ($modelId) use($thisInitModel)
		{
			$this->modelId = $modelId;
			$form = AdminForm::form();	
			$form->items($thisInitModel->create());
			return $form;
		});
	}

	protected function display()
	{
		$display = parent::display();

		$display->with('page');

		return $display;
	}

	protected function filters ()
	{
		return [
			Filter::custom('page')->callback(function ($query, $parameter)
			{
				$query->where(['page_id'=>$parameter]);
			})->title('Cтраница ID: '.Input::get('page')),
		];
	}

	protected function columnFilters ()
	{
		return [
			Column::checkbox(),
			ColumnFilter::text(),
			ColumnFilter::text(),
			(Input::has('page')) ? null : ColumnFilter::select()->model('App\Page')->display('title')
		];
	}

	public function column ()
	{
		return [
			Column::string('name')->label('Name'),
			Column::string('value')->label('Value'),
			Column::string('page.id')->label('Page ID')->orderable(false),
		];
	}

	public function create ()
	{
		return [
			$this->getNameField(),
		    $this->getValueField(),
		    $this->getTypeField(),
		    $this->getPageIdField(),
		    $this->getPageIdHiddenField()
		];
	}

	public function update ()
	{
		return $this->create();
	}

	protected function getPageIdField ()
	{	
		if ($this->getPage())
		{
			return FormItem::jBottonLink()->url('pages/:id/edit')->valueUrl(['id'=>$this->getPage()->id])->label('Перейти на страницу')->issetObject(false);
		}
		return null;
	}

	protected function getPageIdHiddenField ()
	{	

		if ($this->getPage())
		{
			return FormItem::hidden('page_id', 'Page ID')->defaultValue($this->getPage()->id);
		}
		return FormItem::hidden('page_id', 'Page ID');
	}

	protected function getTypeField ()
	{
		//return FormItem::text('type', 'Type');
		return FormItem::select('type', 'type')->options([
			'text' => 'Text',
			'textarea'=>'Textarea',
			'image' => 'Image'
		]);
	}

	protected function getValueField()
	{
		$model = $this->model();
		if ($model !== null)
		{
			$type = $this->getType();
			if (!$type)
			{
				$type = 'text';
			}

			return FormItem::$type('value', 'Value');
		}
		return FormItem::text('value', 'Value');
	}

	protected function getNameField()
	{
		return FormItem::text('name', 'Name');
	}

	protected function getPage()
	{
		if ($this->model() and $this->model()->page)
		{

			return $this->model()->page;
		}
		else 
		{
			if (Input::has('page'))
			{
				$page = Model_Page::find(Input::get('page'));
				if ($page)
				{
					return $page;
				}
			}
		}
		return null;
	}

	protected function getType ($default = null)
	{ 
		$defaultValue = null;
		
		if ($this->model() and $this->model()->type)
		{
			return $this->model()->type;
		}

		if ($this->getPage() and $this->model())
		{
			$defaultValue = config('jetcms.page_template.'.$this->getPage()->template.'.page_filed.'.$this->model()->name);
		}

		if (isset($defaultValue['type']))
		{
			return $defaultValue['type'];
		}
		return $default;
	}
}