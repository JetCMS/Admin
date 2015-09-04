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

//JetCMS\Admin\Controller::register('Users', \JetCMS\Admin\BaseController::class);

JetCMS\Admin\Controller::register('Users', \JetCMS\Admin\Controller\User::class);
JetCMS\Admin\Controller::register('PageField', \JetCMS\Admin\Controller\PageField::class);
