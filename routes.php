<?php 

Route::controllers([
	'auth' => 'App\Http\Controllers\Auth\AuthController',
	'password' => 'App\Http\Controllers\Auth\PasswordController',
]);

Route::get('home', 'HomeController@index');

Route::get('/admin/401', array('as' => 'admin.401', function()
{
    return view('jetcms::admin.401',['title'=>401]);
}));

Route::get('/', function () {
	if (!Auth::check())
	{
		return 'Сайт не доступен';
	}


	$clients = App\Gallery::where(['name'=>'clients'])->first()->images;
	$portfolio = App\Gallery::where(['name'=>'portfolio'])->first()->images;
	$menu = App\Menu::roots()->where(['active'=>true])->get();
	$comments = App\Comment::where(['active'=>true])->with('user')->get();
	$form = App\Form::where(['name'=>'zayavka','active'=>true])->with('fields')->first();
	$page = [];

	foreach (App\Page::where(['active'=>true])->get() as $key => $val) 
	{
		$page[$val->alias] = $val;
	}


    return view('welcome',compact('clients','portfolio','menu','comments','page','form'));
});


Route::post('/mail/{name?}', function () {

	Mail::send('emails.key_val', array('inner' => Input::all()), function($message)
	{
	    $message->to('52018@bk.ru', 'Алексей')->subject('Заявка!');
	});

	return response()->json(['title'=>'Спасибо!','content'=>'Наши менеджеры свяжутся с Вами']);
});
