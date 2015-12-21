<div class="form-group">
	@if ($url)
		<a href="/{{config('admin.prefix')}}/{{$url}}" class="form-control btn btn-default flat">{{$lable}}</a>
	@else
		<span>
			<span class="form-control btn btn-default flat">{{$lable}}</span><br />
			<span class="text-danger">{{$labelNonObject or ''}}</span>
		</span>
	@endif
</div>