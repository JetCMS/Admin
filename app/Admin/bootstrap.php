<?php

/*
 * Describe you custom displays, columns and form items here.
 *
 *		Display::register('customDisplay', '\Foo\Bar\MyCustomDisplay');
 *
 *		Column::register('customColumn', '\Foo\Bar\MyCustomColumn');
 *
 * 		FormItem::register('customElement', \Foo\Bar\MyCustomElement::class);
 *
 */

FormItem::register('jBottonLink', \JetCMS\Admin\FormItems\JBottonLink::class);
FormItem::register('jSelect', \JetCMS\Admin\FormItems\JSelect::class);

JetCMS\Admin\Controller::register('FormField', \JetCMS\Admin\Controller\FormField::class);
JetCMS\Admin\Controller::register('Form', \JetCMS\Admin\Controller\Form::class);
JetCMS\Admin\Controller::register('GalleryImage', \JetCMS\Admin\Controller\GalleryImage::class);
JetCMS\Admin\Controller::register('Gallery', \JetCMS\Admin\Controller\Gallery::class);
JetCMS\Admin\Controller::register('Page', \JetCMS\Admin\Controller\Page::class);
JetCMS\Admin\Controller::register('Menu', \JetCMS\Admin\Controller\Menu::class);
JetCMS\Admin\Controller::register('Role', \JetCMS\Admin\Controller\Role::class);
JetCMS\Admin\Controller::register('Comment', \JetCMS\Admin\Controller\Comment::class);
JetCMS\Admin\Controller::register('Users', \JetCMS\Admin\Controller\User::class);
JetCMS\Admin\Controller::register('PageField', \JetCMS\Admin\Controller\PageField::class);
