@extends('layouts/default')

{{-- Page title --}}
@section('title')
	@parent
	: {{{ trans("platform/users::groups/general.{$mode}") }}}
@stop

{{-- Queue assets --}}
{{ Asset::queue('validate', 'platform/js/validate.js', 'jquery') }}
{{ Asset::queue('bootstrap.tabs', 'bootstrap/js/tab.js', 'jquery') }}

{{-- Inline scripts --}}
@section('scripts')
@parent
<script type="text/javascript">
	H5F.setup(document.getElementById('groups-form'));
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

	<h1>{{{ trans("platform/users::groups/general.{$mode}") }}} <small>{{{ $group->name }}}</small></h1>

</div>

{{-- Groups form --}}
<form id="groups-form" class="form-horizontal" action="{{ Request::fullUrl() }}" method="post" accept-char="UTF-8" autocomplete="off">

	{{-- CSRF Token --}}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	{{-- Tabs --}}
	<ul class="nav nav-tabs">
		<li class="active"><a href="#general" data-toggle="tab">{{{ trans('platform/users::general.tabs.general') }}}</a></li>
		<li><a href="#permissions" data-toggle="tab">{{{ trans('platform/users::general.tabs.permissions') }}}</a></li>
		<li><a href="#attributes" data-toggle="tab">{{{ trans('platform/users::general.tabs.attributes') }}}</a></li>
	</ul>

	{{-- Tabs content --}}
	<div class="tab-content tab-bordered">

		{{-- General tab --}}
		<div class="tab-pane active" id="general">

			{{-- Name --}}
			<div class="form-group{{ $errors->first('name', ' has-error') }}">
				<label for="name" class="col-lg-2 control-label">{{{ trans('platform/users::groups/form.name') }}}</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" name="name" id="name" placeholder="{{{ trans('platform/users::groups/form.name') }}}" value="{{{ Input::old('name', $group->name) }}}">

					<span class="help-block">
						{{{ $errors->first('name', ':message') ?: trans('platform/users::groups/form.name_help') }}}
					</span>
				</div>
			</div>

			{{-- Slug --}}
			<div class="form-group{{ $errors->first('slug', ' has-error') }}">
				<label for="slug" class="col-lg-2 control-label">{{{ trans('platform/users::groups/form.slug') }}}</label>
				<div class="col-lg-10">
					<input type="text" class="form-control" name="slug" id="slug" placeholder="{{{ trans('platform/users::groups/form.slug') }}}" value="{{{ Input::old('slug', $group->slug) }}}">

					<span class="help-block">
						{{{ $errors->first('slug', ':message') ?: trans('platform/users::groups/form.slug_help') }}}
					</span>
				</div>
			</div>

		</div>

		{{-- Permissions tab --}}
		<div class="tab-pane" id="permissions">

			@include('platform/users::groups/partials/permissions')

		</div>

		{{-- Attributes tab --}}
		<div class="tab-pane" id="attributes">

			@widget('platform/attributes::entity.form', array($group))

		</div>

	</div>

	{{-- Form actions --}}
	<div class="form-group">

		<div class="col-lg-12 text-right">

			<button class="btn btn-success" type="submit">{{{ trans('button.save') }}}</button>

			<a class="btn btn-default" href="{{{ URL::toAdmin('users/groups') }}}">{{{ trans('button.cancel') }}}</a>

			@if ($group->exists)
			<a class="btn btn-danger" data-toggle="modal" data-target="modal-confirm" href="{{ URL::toAdmin("users/groups/{$group->id}/delete") }}">{{{ trans('button.delete') }}}</a>
			@endif

		</div>

	</div>

</form>

@stop
