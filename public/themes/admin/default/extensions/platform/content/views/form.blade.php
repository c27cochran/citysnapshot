@extends('layouts/default')

{{-- Page title --}}
@section('title')
	@parent
	: {{{ trans("platform/content::general.{$mode}") }}} {{{ $content->exists ? '- ' . $content->name : null }}}
@stop

{{-- Queue assets --}}
{{ Asset::queue('redactor', 'imperavi/css/redactor.css', 'styles') }}

{{ Asset::queue('slugify', 'platform/js/slugify.js', 'jquery') }}
{{ Asset::queue('validate', 'platform/js/validate.js', 'jquery') }}
{{ Asset::queue('bootstrap.tabs', 'bootstrap/js/tab.js', 'jquery') }}
{{ Asset::queue('redactor', 'imperavi/js/redactor.min.js', 'jquery') }}
{{ Asset::queue('content', 'platform/content::js/scripts.js', 'jquery') }}

{{-- Inline scripts --}}
@section('scripts')
@parent
@stop

{{-- Inline styles --}}
@section('styles')
@parent
@stop

{{-- Page content --}}
@section('content')

{{-- Page header --}}
<div class="page-header">

	<h1>{{{ trans("platform/content::general.{$mode}") }}} <small>{{{ $content->name }}}</small></h1>

</div>

{{-- Content form --}}
<form id="content-form" action="{{ Request::fullUrl() }}" method="post" accept-char="UTF-8" autocomplete="off">

	{{-- CSRF Token --}}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	{{-- Tabs --}}
	<ul class="nav nav-tabs">
		<li class="active"><a href="#general" data-toggle="tab">{{{ trans('platform/content::general.tabs.general') }}}</a></li>
		<li><a href="#attributes" data-toggle="tab">{{{ trans('platform/content::general.tabs.attributes') }}}</a></li>
	</ul>

	{{-- Tabs content --}}
	<div class="tab-content tab-bordered">

		{{-- General tab --}}
		<div class="tab-pane active" id="general">

			<div class="row">

				{{-- Name --}}
				<div class="col-lg-6">

					<div class="form-group{{ $errors->first('name', ' has-error') }}">

						<label for="name" class="control-label">{{{ trans('platform/content::form.name') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/content::form.name_help') }}}"></i></label>

						<input type="text" class="form-control" name="name" id="name" placeholder="{{{ trans('platform/content::form.name') }}}" value="{{{ Input::old('name', $content->name) }}}" required>

						<span class="help-block">{{{ $errors->first('name', ':message') }}}</span>

					</div>

				</div>

				{{-- Slug --}}
				<div class="col-lg-3">

					<div class="form-group{{ $errors->first('slug', ' has-error') }}">

						<label for="slug" class="control-label">{{{ trans('platform/content::form.slug') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/content::form.slug_help') }}}"></i></label>

						<input type="text" class="form-control" name="slug" id="slug" placeholder="{{{ trans('platform/content::form.slug') }}}" value="{{{ Input::old('slug', $content->slug) }}}" required>

						<span class="help-block">{{{ $errors->first('slug', ':message') }}}</span>

					</div>

				</div>

				{{-- Enabled --}}
				<div class="col-lg-3">

					<div class="form-group{{ $errors->first('enabled', ' has-error') }}">

						<label for="enabled" class="control-label">{{{ trans('platform/content::form.enabled') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/content::form.enabled_help') }}}"></i></label>

						<select class="form-control" name="enabled" id="enabled" required>
							<option value="1"{{ Input::old('enabled', $content->enabled) == 1 ? ' selected="selected"' : null }}>{{{ trans('general.enabled') }}}</option>
							<option value="0"{{ Input::old('enabled', $content->enabled) == 0 ? ' selected="selected"' : null }}>{{{ trans('general.disabled') }}}</option>
						</select>

						<span class="help-block">{{{ $errors->first('enabled', ':message') }}}</span>

					</div>

				</div>

			</div>

			<div class="row">

				{{-- Type --}}
				<div class="col-lg-6">

					<div class="form-group{{ $errors->first('type', ' has-error') }}">

						<label for="type" class="control-label">{{{ trans('platform/content::form.type') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/content::form.type_help') }}}"></i></label>

						<select class="form-control" name="type" id="type" required>
							<option value="database"{{ Input::old('type', $content->type) == 'database' ? ' selected="selected"' : null }}>{{{ trans('platform/content::form.database') }}}</option>
							<option value="filesystem"{{ Input::old('type', $content->type) == 'filesystem' ? ' selected="selected"' : null }}>{{{ trans('platform/content::form.filesystem') }}}</option>
						</select>

						<span class="help-block">{{{ $errors->first('type', ':message') }}}</span>

					</div>

				</div>

				{{-- Type : Filesystem --}}
				<div class="col-lg-6">

					<div data-type="filesystem" class="{{ Input::old('type', $content->type) == 'database' ? ' hide' : null }}">

						<div class="form-group{{ $errors->first('file', ' error') }}">

							<label for="file" class="control-label">{{{ trans('platform/content::form.file') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/content::form.file_help') }}}"></i></label>

							<select class="form-control" name="file" id="file"{{ Input::old('type', $content->type) == 'filesystem' ? ' required' : null }}>
							@foreach ($files as $value => $name)
								<option value="{{ $value }}"{{ Input::old('file', $content->file) == $value ? ' selected="selected"' : null}}>{{ $name }}</option>
							@endforeach
							</select>

							<span class="help-block">{{{ $errors->first('file', ':message') }}}</span>

						</div>

					</div>

				</div>

			</div>

			{{-- Type : Database --}}
			<div data-type="database"class="{{ Input::old('type', $content->type) == 'filesystem' ? ' hide' : null }}">

				<div class="form-group{{ $errors->first('value', ' has-error') }}">

					<label for="value" class="control-label">{{{ trans('platform/content::form.value') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/content::form.value_help') }}}"></i></label>

					<textarea class="form-control redactor" name="value" id="value"{{ Input::old('type', $content->type) == 'database' ? ' required' : null }}>{{{ Input::old('value', $content->value) }}}</textarea>

					<span class="help-block">{{{ $errors->first('value', ':message') }}}</span>

				</div>

			</div>

		</div>

		{{-- Attributes tab --}}
		<div class="tab-pane clearfix" id="attributes">

			@widget('platform/attributes::entity.form', [$content])

		</div>

	</div>

	{{-- Form actions --}}
	<div class="row">

		<div class="col-lg-12 text-right">

			{{-- Form actions --}}
			<div class="form-group">

				<button class="btn btn-success" type="submit">{{{ trans('button.save') }}}</button>

				<a class="btn btn-default" href="{{{ URL::toAdmin('content') }}}">{{{ trans('button.cancel') }}}</a>

				@if ($content->exists and $mode != 'copy')
				<a class="btn btn-info" href="{{ URL::toAdmin("content/{$content->slug}/copy") }}">{{{ trans('button.copy') }}}</a>

				<a class="btn btn-danger" data-toggle="modal" data-target="modal-confirm" href="{{ URL::toAdmin("content/{$content->slug}/delete") }}">{{{ trans('button.delete') }}}</a>
				@endif

			</div>

		</div>

	</div>

</form>

@stop
