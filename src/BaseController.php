<?php namespace JetCMS\Admin;

use Input;

use Admin;
use AdminForm;
use AdminDisplay;
use Filter;
use ColumnFilter;
use Column;
use FormItem;

class BaseController
{
	protected $modelId = null;
	protected $model = null;
	protected $modelNull = false;

	public function model()
	{
		if ($this->model !== null)
		{
			return $this->model;
		}
		
		if (!$this->modelNull)
		{
			$this->model = $this->queryModel()->first();

			if (!$this->model)
			{
				$this->modelNull = true;
			}
		}
		return $this->model;
	}

	public function getModelClass()
	{
		return \App\User::class;
	}

	protected function queryModel()
	{
		return $this->getModel();
	}

	public function init($name)
	{
		$thisInitModel = $this;

		Admin::model($this->getModelClass())->title($name)->display(function () 
			use ($thisInitModel)
		{

			$display = $this->display();

			$filter = $thisInitModel->filters();
			if (sizeof($filter)>0)
			{
				$display->filters($filter);
			}

			$columnFilters = $thisInitModel->columnFilters();
			if (sizeof($columnFilters)>0)
			{
				$display->columnFilters($columnFilters);			
			}
			
			$columns = $thisInitModel->column();
			if (sizeof($columns)>0)
			{
				$display->columns($columns);
			}

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
		$display = AdminDisplay::datatablesAsync();

		$display->attributes([
		    'ordering' => false,
		    'stateSave' => false,
		]);

		return $display;
	}

	protected function filters ()
	{
		return [];
	}

	protected function columnFilters ()
	{
		return [];
	}

	protected function column ()
	{
		return [
			Column::string('name')->label('Name'),
			Column::string('email')->label('Email'),
		];
	}

	public function create ()
	{
		return [
			FormItem::text('name', 'Name')->required(),
			FormItem::text('email', 'Email')->required()->unique(),
		];
	}

	public function update ()
	{
		return $this->create();
	}
}