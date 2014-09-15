@extends('layouts/default')

{{-- Page title --}}
@section('title')
	@parent
	: {{{ trans('platform/operations::workshop/general.title') }}}
@stop

{{-- Queue assets --}}
{{ Asset::queue('validate', 'platform/js/validate.js', 'jquery') }}

{{-- Inline scripts --}}
@section('scripts')
@parent
<script type="text/javascript">
	H5F.setup(document.getElementById('workshop-form'));
</script>
@stop

{{-- Inline styles --}}
@section('styles')
@parent
@stop

{{-- Page content --}}
@section('content')

{{-- Page header --}}
<div class="page-header">

	<h1>{{{ trans('platform/operations::workshop/general.title') }}} <small>Create a new extension</small></h1>

</div>

@if ( ! $canInstall)

<div class="alert alert-danger">
	Make sure the <strong>{{ $workbench }}</strong> directory exists and is writeable by the web so that we can deploy the extension for you!
</div>

@else

<form id="workshop-form" action="{{ Request::fullUrl() }}" method="post" accept-char="UTF-8" autocomplete="off">

	{{-- CSRF Token --}}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="row">

		{{-- Author Name --}}
		<div class="col-lg-6">

			<div class="form-group{{ $errors->first('author', ' has-error') }}">

				<label for="author" class="control-label">{{{ trans('platform/operations::workshop/form.author') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/operations::workshop/form.author_help') }}}"></i></label>

				<input type="text" class="form-control" name="author" id="author" placeholder="{{{ trans('platform/operations::workshop/form.author') }}}" value="{{{ Input::old('author', Config::get('workbench.name')) }}}" required>

				<span class="help-block">{{{ $errors->first('author', ':message') }}}</span>

			</div>

		</div>

		{{-- Author Email --}}
		<div class="col-lg-6">

			<div class="form-group{{ $errors->first('email', ' has-error') }}">

				<label for="email" class="control-label">{{{ trans('platform/operations::workshop/form.email') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/operations::workshop/form.email_help') }}}"></i></label>

				<input type="text" class="form-control" name="email" id="email" placeholder="{{{ trans('platform/operations::workshop/form.email') }}}" value="{{{ Input::old('email', Config::get('workbench.email')) }}}" required>

				<span class="help-block">{{{ $errors->first('email', ':message') }}}</span>

			</div>

		</div>

	</div>

	<div class="row">

		{{-- Vendor --}}
		<div class="col-lg-4">

			<div class="form-group{{ $errors->first('vendor', ' has-error') }}">

				<label for="vendor" class="control-label">{{{ trans('platform/operations::workshop/form.vendor') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/operations::workshop/form.vendor_help') }}}"></i></label>

				<input type="text" class="form-control" name="vendor" id="vendor" placeholder="{{{ trans('platform/operations::workshop/form.vendor') }}}" value="{{{ Input::old('vendor', Config::get('platform/operations::config.vendor')) }}}" required>

				<span class="help-block">{{{ $errors->first('vendor', ':message') }}}</span>

			</div>

		</div>

		{{-- Name --}}
		<div class="col-lg-4">

			<div class="form-group{{ $errors->first('name', ' has-error') }}">

				<label for="name" class="control-label">{{{ trans('platform/operations::workshop/form.name') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/operations::workshop/form.name_help') }}}"></i></label>

				<input type="text" class="form-control" name="name" id="name" placeholder="{{{ trans('platform/operations::workshop/form.name') }}}" value="{{{ Input::old('name') }}}" required>

				<span class="help-block">{{{ $errors->first('name', ':message') }}}</span>

			</div>

		</div>

		{{-- Version --}}
		<div class="col-lg-4">

			<div class="form-group{{ $errors->first('version', ' has-error') }}">

				<label for="version" class="control-label">{{{ trans('platform/operations::workshop/form.version') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/operations::workshop/form.version_help') }}}"></i></label>

				<input type="text" class="form-control" name="version" id="version" placeholder="{{{ trans('platform/operations::workshop/form.version') }}}" value="{{{ Input::old('version', '0.1.0') }}}" required>

				<span class="help-block">{{{ $errors->first('version', ':message') }}}</span>

			</div>

		</div>

	</div>

	{{-- Description --}}
	<div class="form-group{{ $errors->first('description', ' has-error') }}">

		<label for="description" class="control-label">{{{ trans('platform/operations::workshop/form.description') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/operations::workshop/form.description_help') }}}"></i></label>

		<input type="text" class="form-control" name="description" id="description" placeholder="{{{ trans('platform/operations::workshop/form.description') }}}" value="{{{ Input::old('name') }}}" required>

		<span class="help-block">{{{ $errors->first('description', ':message') }}}</span>

	</div>

	{{-- Dependencies --}}
	<div class="form-group{{ $errors->first('require', ' has-error') }}">

		<label for="require" class="control-label">{{{ trans('platform/operations::workshop/form.dependencies') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/operations::workshop/form.dependencies_help') }}}"></i></label>

		<textarea class="form-control" name="require" id="require" rows="5">{{{ Input::old('require') }}}</textarea>

		<span class="help-block">{{{ $errors->first('require', ':message') }}}</span>

	</div>

	{{-- Form actions --}}
	<div class="row">

		<div class="col-lg-12 text-right">

			<div class="form-group">

				<button class="btn btn-success" type="submit">{{{ trans('button.save') }}}</button>

				<a class="btn btn-default" href="{{{ URL::toAdmin('operations') }}}">{{{ trans('button.cancel') }}}</a>

			</div>

		</div>

	</div>

</form>

@endif

@stop
