@extends(AdminTemplate::view('_layout.base'))

@section('body', '<body class="login-page">')

@section('content')
	<div class="login-box">
		<div class="login-logo">
			<b>{{ config('admin.title') }}</b>
		</div>
		<div class="login-box-body">
			<p class="login-box-msg text-danger">{{ trans('jetcms::lang.auth.401') }}</p>

				<div class="row">
					<div class="col-xs-6"><a href="{{  route('home') }}" class="btn btn-primary btn-block btn-flat">{{ trans('jetcms::lang.auth.beack') }}</a></div>
					<div class="col-xs-6">
						<a href="{{ route('admin.logout') }}" class="btn btn-danger btn-block btn-flat">{{ trans('admin::lang.auth.logout') }}</a>
					</div>
				</div>
	
		</div>
	</div>
@stop
