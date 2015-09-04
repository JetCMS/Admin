<?php

Admin::menu()->url('/')->label('Start Page')->icon('fa-dashboard');

Admin::menu()->label('Access')->icon('fa-lock')->items(function ()
{
    Admin::menu(App\User::class)->icon('fa-user');
	Admin::menu(App\Role::class)->icon('fa-group');
});

Admin::menu(App\Menu::class)->icon('fa-sitemap');

Admin::menu()->label('Pages')->icon('fa-folder-o')->items(function ()
{
	Admin::menu(App\Page::class)->icon('fa-file-text-o');
	Admin::menu(App\PageField::class)->icon('fa-plus-square');
});

Admin::menu()->label('Gallery')->icon('fa-image')->items(function ()
{
	Admin::menu(App\Gallery::class)->icon('fa-folder-o');
	Admin::menu(App\GalleryImage::class)->icon('fa-image');
});

Admin::menu(App\Comment::class)->icon('fa-comments');

Admin::menu()->label('Mail')->icon('fa-paper-plane-o')->items(function ()
{
	Admin::menu(App\Form::class)->icon('fa-list-alt');
});
