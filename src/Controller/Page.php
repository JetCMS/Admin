<?php namespace JetCMS\Admin\Controller;

use AdminAuth;
use Filter;
use Column;
use FormItem;
use Carbon;

use AdminForm;
use AdminDisplay;

use App\Page as Model_Page;
use App\Menu as Model_Menu;

use JetCMS\Admin\BaseController;

class Page extends BaseController
{

	protected $import_disble = ['page_field_to_array','make_alias','fields'];
	protected $import_model_name = 'page';
	protected $formTemplateField = ['main'=>'Основной | main'];


	public function getModelClass()
	{
		return Model_Page::class;
	}

	protected function display()
	{
		$display = parent::display();
		$display->with('fields','user');
/*
		$display->apply(function ($query)
		{
			$query->where('context', 'page');
		});
*/
		$display->actions($this->importAction());

		return $display;
	}

	protected function filters ()
	{
		return [
			Filter::field('context')
		];
	}

	public function column ()
	{
		return [
			Column::checkbox(),
			Column::image('image')->label('Image'),
			Column::string('title')->label('Title'),
			Column::string('alias')->label('Alias'),
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

					if (substr($instance->menu->url,1) == $instance->make_alias)
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
		];
	}

	public function create ()
	{
		return [
			FormItem::columns()->columns([
		       	[
					FormItem::text('title', 'Title')->required(),
					FormItem::text('alias', 'Alias'),
					FormItem::textarea('description', 'Description'),
					FormItem::select('user_id', 'User')->model('App\User')->display('name')->defaultValue(AdminAuth::User()->id)->nullable(),
					FormItem::multiselect('tag', 'Tag')->model('App\Tag')->display('lable')
				],[
					FormItem::jSelect('menu_id', 'Menu id')->options(Model_Menu::getNestedList('level_lable'))->nullable(),
					FormItem::text('policies', 'Policies'),

					$this->formTemplateField(),

					FormItem::timestamp('publish', 'Publish')->defaultValue(Carbon::now()),
					FormItem::text('sort', 'Sort'),

					$this->formContextField(),

					FormItem::checkbox('active')->label('Active'),

					FormItem::jBottonLink()->url('fields?page=:id')->label('Дополнительные поля')->labelNonObject('Требуется сохранить объект'),
				],
			]),

			FormItem::ckeditor('content', 'Content'),

			FormItem::columns()->columns([
				[
					$this->createField(),
				],[
					FormItem::image('image', 'Image'),
					FormItem::images('gallery', 'Gallery'),
				]

			]),
		];
	}

	protected function createField(){
		return FormItem::jMigx('field_array', 'Fields')->options([
			'description' => ['type'=>'textarea','lable'=>'Описание в списке новостей'],
			'title' => ['type'=>'text','lable'=>'Заголовок в списке новостей'],
		]);
	}


	protected function getForm($modelId) {

		$form = AdminForm::form();
		$form->items($this->create());

		$display = AdminDisplay::tabbed();
		return $display->tabs(function () use ($form)
		{
			$tabs = [];
			$tabs[] = AdminDisplay::tab($form)->label('Основное')->active(true);
			return $tabs;
		});
	}

	public function formTemplateField()
	{
		return FormItem::select('template', 'Template')->options($this->formTemplateField)->defaultValue('main');
	}

	public function formContextField()
	{
		return FormItem::text('context', 'Context')->defaultValue('page'); //->readonly('readonly')
	}
}