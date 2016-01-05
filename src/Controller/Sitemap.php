<?php namespace JetCMS\Admin\Controller;

use Input;

use Admin;
use AdminForm;
use AdminDisplay;
use Filter;
use ColumnFilter;
use Column;
use FormItem;

use App\Sitemap as Model_Image;

use JetCMS\Admin\BaseController;

class Sitemap extends BaseController
{
    public function getModelClass()
    {
        return Model_Image::class;
    }

    protected function display()
    {
        $display = parent::display();
        return $display;
    }

    public function column ()
    {
        return [
            Column::checkbox(),
            Column::string('loc')->label('loc'),
            Column::string('lastmod')->label('lastmod'),
            Column::string('changefreq')->label('changefreq'),
            Column::string('priority')->label('priority'),
            Column::string('updated_at')->label('updated_at'),
            Column::custom()->label('in_sitemap')->callback(function ($instance)
            {
                if ($instance->in_sitemap)
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
                    FormItem::text('loc', 'loc')->required(),
                    FormItem::timestamp('lastmod', 'lastmod')->required(),
                    FormItem::select('changefreq', 'changefreq')->enum(['always', 'hourly', 'daily', 'weekly', 'monthly', 'yearly', 'never'])->required(),
                    FormItem::text('priority', 'priority')->required(),
                    FormItem::checkbox('in_sitemap')->label('In sitemap'),
                ]
            ]),
        ];
    }
}