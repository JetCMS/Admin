<?php namespace JetCMS\Admin;

use Input;
use Storage;
use Carbon;
use DB;
use Excel;

use Admin;
use AdminForm;
use AdminDisplay;
use Column;
use FormItem;

class BaseController
{
	protected $modelId = null;
	protected $model = null;
	protected $modelNull = false;

/*
	protected $import_disble = [];
	protected $import_model_name = null;
*/

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
/*
	protected function queryModel()
	{
		return $this->getModel();
	}
*/
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
		    'ordering' => true,
		    'stateSave' => false,
		]);

		$display->actions($this->importAction());

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
			Column::checkbox(),
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

	/**
	 * import
	 * @param $json
	 * @param $page
	 * @return mixed
	 */
	protected function import($json,$page) {
		unset($json['id']);
		if (is_array($json)){
			foreach ($json as $k=>$v){
				if ( !in_array($k,$this->import_disble)) {
					$page->$k = $v;
				}
			}
		}
		return $page;
	}

	protected function importPath($page){
		return 'arhive'.DIRECTORY_SEPARATOR.$this->import_model_name.DIRECTORY_SEPARATOR.$page->id.DIRECTORY_SEPARATOR
		.$this->import_model_name.'_id'.$page->id.'_'.$page->updated_at->getTimestamp().'.json';
	}

	public function importAction($save = true, $load = true, $import = true, $export = true ){

		$arr = [];
/*
		if ($save) {
			$arr[] = Column::action('save_file')->value('Save File')->target('_blank')->icon('fa-download')->callback(function ($collection) {
				$info = [];

				foreach ($collection as $val) {
					$path = $this->importPath($val);
					if (!Storage::disk('local')->exists($path)) {
						Storage::disk('local')->put($path, $val->toJson());
						$info[] = 'OK | '.$path;
					}else{
						$info[] = 'exists | '.$path;
					}

				}
				dd($info);
			});
		}

		if ($load) {
			$arr[] = Column::action('load_file')->value('Load file')->target('_blank')->icon('fa-upload')->callback(function ($collection) {
				$info = [];

				foreach ($collection as $val) {
					$path = 'arhive/' . $this->import_model_name . '/' . $val->id;
					$files = Storage::disk('local')->files($path);
					$lostFiels = end($files);
					if (isset($lostFiels)) {
						$json = json_decode(Storage::disk('local')->get($lostFiels), true);
						$page = $this->import($json, $val);
						$page->save();
						$info[] = 'OK | '.$lostFiels;
						$info[] = $files;
					}else{
						$info[] = 'errror | '.$lostFiels;
						$info[] = $files;
					}
				}
				dd($info);
			});
		}

		if ($import) {
			$arr[] = Column::action('import')->value('Import')->target('_blank')->icon('fa-download')->callback(function ($collection) {
				$info = [];

				$path = 'import/' . $this->import_model_name . '/';
				$fiels = Storage::disk('local')->files($path);

				foreach ($fiels as $file) {
					$json = json_decode(Storage::disk('local')->get($file), true);
					$model = $this->getModelClass();
					$page = $model::find($json['id']);
					if (isset($page) and $page == true) {
						$page = $this->import($json, $page);
						if (!Storage::disk('local')->exists($this->importPath($page))) {
							$page->save();
							Storage::disk('local')->move($file, $this->importPath($page));
							$info[] = 'OK | isset: '.$file.' | '.$this->importPath($page);
						}else{
							$info[] = 'exists | '.$file.' => '.$this->importPath($page);
						}

					} else {
						$model = $this->getModelClass();
						$page = new $model;
						$page = $this->import($json, $page);
						$page->save();
						Storage::disk('local')->move($file, $this->importPath($page));
						$info[] = 'OK | new: '.$file.' => '.$this->importPath($page);
					}
				}
				dd($info);
			});
		}

		if ($export) {
			$arr[] = Column::action('export')->value('Export')->target('_blank')->icon('fa-upload')->callback(function ($collection) {
				$info = [];
				foreach ($collection as $val) {
					$path = 'export' . DIRECTORY_SEPARATOR . $this->import_model_name . DIRECTORY_SEPARATOR . $this->import_model_name . '_id' . $val->id . '_' . $val->updated_at->getTimestamp() . '.json';
					if (!Storage::disk('local')->exists($path)) {
						Storage::disk('local')->put($path, $val->toJson());
						$info[] = 'OK | '.$path;
					}else{
						$info[] = 'exists | '.$path;
					}
				}
				dd($info);
			});
		}
*/
		$arr[] = Column::action('export_xsl')->value('Export excel')->target('_blank')->icon('fa-upload')->callback
		(function ($collection) {
			$ids = [];
			foreach ($collection as $val) {
				$ids[] = $val->id;
			}
			$class = $this->getModelClass();
			$model = new $class;
			$info  = [
				['key' => 'site','value'=>config('admin.title')],
				['key' => 'table','value'=>$model->getTable()],
				['key' => 'create','value'=>Carbon::now()],
			];

			$data = DB::table($model->getTable())->whereIn('id',$ids)->get();

			$arr = [];

			foreach ($data as $val) {
				$a = [];
				foreach ($val as $k => $v) {
					$a[$k] = $v;
				}
				$arr[] = $a;
			}

			return Excel::create('export_table.'.DB::getDatabaseName().'.'.$model->getTable(), function ($excel) use ($arr,
				$info) {

				$excel->sheet('date', function ($sheet) use ($arr) {
					$sheet->fromArray($arr);
				});

				$excel->sheet('info', function ($sheet) use ($info) {
					$sheet->fromArray($info);
				});

			})->export('xls');

		});

		return $arr;
	}
}