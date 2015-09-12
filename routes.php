<?php 

Route::get('/admin/401', array('as' => 'admin.401', function()
{
    return view('jetcms::admin.401',['title'=>401]);
}));
