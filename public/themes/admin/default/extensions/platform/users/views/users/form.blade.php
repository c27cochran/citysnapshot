@extends('layouts/default')

{{-- Page title --}}
@section('title')
	@parent
	: {{{ trans("platform/users::users/general.{$mode}") }}}
@stop

{{-- Queue assets --}}
{{ Asset::queue('validate', 'platform/js/validate.js', 'jquery') }}
{{ Asset::queue('bootstrap.tabs', 'bootstrap/js/tab.js', 'jquery') }}

{{-- Inline scripts --}}
@section('scripts')
@parent
<script type="text/javascript">
	H5F.setup(document.getElementById('users-form'));
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

	<h1>{{{ trans("platform/users::users/general.{$mode}") }}} <small>{{{ ($user->first_name and $user->last_name) ? "{$user->first_name} {$user->last_name}" : $user->email }}}</small></h1>

</div>

{{-- Users form --}}
<form id="users-form" class="form-horizontal" action="{{ Request::fullUrl() }}" method="post" accept-char="UTF-9" autocomplete="off">

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

			@include('platform/users::users/partials/general')

		</div>

		{{-- Permissions tab --}}
		<div class="tab-pane" id="permissions">

			@include('platform/users::users/partials/permissions')

		</div>

		{{-- Attributes tab --}}
		<div class="tab-pane" id="attributes">

			@widget('platform/attributes::entity.form', array($user))

		</div>

	</div>

	{{-- Form actions --}}
	<div class="form-group">

		<div class="col-lg-12 text-right">

			<button class="btn btn-success" type="submit">{{{ trans('button.save') }}}</button>

			<a class="btn btn-default" href="{{{ URL::toAdmin('users') }}}">{{{ trans('button.cancel') }}}</a>

			@if ($user->exists and Sentinel::getUser()->id != $user->id)
			<a class="btn btn-danger" data-toggle="modal" data-target="modal-confirm" href="{{ URL::toAdmin("users/{$user->id}/delete") }}">{{{ trans('button.delete') }}}</a>
			@endif

		</div>

	</div>

</form>

@stop
