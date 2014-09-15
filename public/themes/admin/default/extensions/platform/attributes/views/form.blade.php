@extends('layouts/default')

{{-- Page title --}}
@section('title')
	@parent
	: {{{ trans("platform/attributes::general.{$mode}") }}}
@stop

{{-- Queue assets --}}
{{ Asset::queue('attributes', 'platform/attributes::css/style.less') }}
{{ Asset::queue('selectize', 'selectize/css/selectize.css', 'styles') }}

{{ Asset::queue('validate', 'platform/js/validate.js', 'jquery') }}
{{ Asset::queue('sortable', 'platform/attributes::js/jquery.sortable.js', 'jquery') }}
{{ Asset::queue('selectize', 'selectize/js/selectize.js', 'jquery') }}
{{ Asset::queue('attributes', 'platform/attributes::js/scripts.js', array('sortable', 'selectize')) }}

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

	<h1>{{{ trans("platform/attributes::general.{$mode}") }}} <small>{{{ $attribute->exists ? $attribute->name : null }}}</small></h1>

</div>

{{-- Attributes form --}}
<form id="attributes-form" action="{{ Request::fullUrl() }}" method="post" accept-char="UTF-8" autocomplete="off">

	{{-- CSRF Token --}}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<div class="row">

	 	<div class="col-lg-5">

			<div class="row">

				<div class="col-lg-6">

					{{-- Name --}}
					<div class="form-group{{ $errors->first('name', ' has-error') }}">
						<label for="name" class="control-label">{{{ trans('platform/attributes::form.name') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/attributes::form.name_help') }}}"></i></label>

						<input type="text" class="form-control" name="name" id="name" placeholder="{{{ trans('platform/attributes::form.name') }}}" value="{{{ Input::old('name', $attribute->exists ? $attribute->name : null) }}}" required>

						<span class="help-block">{{{ $errors->first('name', ':message') }}}</span>
					</div>

				</div>

				{{-- Slug --}}
				<div class="col-lg-6">

					<div class="form-group{{ $errors->first('slug', ' has-error') }}">
						<label for="slug" class="control-label">{{{ trans('platform/attributes::form.slug') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/attributes::form.slug_help') }}}"></i></label>

						<input type="text" class="form-control" name="slug" id="slug" placeholder="{{{ trans('platform/attributes::form.slug') }}}" value="{{{ Input::old('slug', $attribute->exists ? $attribute->slug : null) }}}" required>

						<span class="help-block">{{{ $errors->first('slug', ':message') }}}</span>
					</div>

				</div>

			</div>

			{{-- Namespace --}}
			<div class="form-group{{ $errors->first('namespace', ' has-error') }}">
				<label for="namespace" class="control-label">{{{ trans('platform/attributes::form.namespace') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/attributes::form.namespace_help') }}}"></i></label>

				<select class="selectize" data-selectize="create" name="namespace" id="namespace" class="form-control">
					<option value="">Select a namespace...</option>
					@foreach ($namespaces as $namespace)
					<option {{ Input::old('namespace', $attribute->exists ? $attribute->namespace : Input::get('namespace')) === $namespace ? ' selected="selected"' : null }} value="{{{ $namespace }}}">{{{ $namespace }}}</option>
					@endforeach
				</select>

				<span class="help-block">{{{ $errors->first('namespace', ':message') }}}</span>
			</div>

			<div class="row">

				{{-- Type --}}
				<div class="col-lg-6">

					<div class="form-group{{ $errors->first('type', ' has-error') }}">
						<label for="type" class="control-label">{{{ trans('platform/attributes::form.type') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/attributes::form.type_help') }}}"></i></label>

						<select class="form-control" name="type" id="type" required>
						<option value="">Select a type...</option>
						@foreach ($types as $type)
							<option data-allow-options="{{ $type->allowOptions() ?: 0 }}"{{ Input::old('type', $attribute->exists ? $attribute->type : null) === $type->getIdentifier() ? ' selected="selected"' : null }} value="{{ $type->getIdentifier() }}">{{ $type->getName() }}</option>
						@endforeach
						</select>

						<span class="help-block">{{{ $errors->first('type', ':message') }}}</span>
					</div>

				</div>

				{{-- Enabled --}}
				<div class="col-lg-6">

					<div class="form-group{{ $errors->first('enabled', ' has-error') }}">
						<label for="enabled" class="control-label">{{{ trans('platform/attributes::form.enabled') }}} <i class="fa fa-info-circle" data-toggle="popover" data-content="{{{ trans('platform/attributes::form.enabled_help') }}}"></i></label>

						<select class="form-control" name="enabled" id="enabled" required>
							<option value="">Select a status...</option>
							<option value="1"{{ Input::old('enabled', $attribute->exists ? (int) $attribute->enabled : 1) === 1 ? ' selected="selected"' : null }}>{{{ trans('general.enabled') }}}</option>
							<option value="0"{{ Input::old('enabled', $attribute->exists ? (int) $attribute->enabled : 1) === 0 ? ' selected="selected"' : null }}>{{{ trans('general.disabled') }}}</option>
						</select>

						<span class="help-block">{{{ $errors->first('enabled', ':message') }}}</span>
					</div>

				</div>

			</div>

		</div>

		<div class="col-lg-7">

			<div class="hide" data-options>

				<table class="table table-hover table-bordered">
					<tbody>
						{{-- Show options here --}}
						@foreach ($options as $value => $label)
						<tr data-clonable>
							<td><i data-option-move class="fa fa-arrows"></i></td>
							<td><input class="form-control" name="options[{{ $value }}][value]" type="text" value="{{{ $value }}}" placeholder="{{{ trans('platform/attributes::form.option.value') }}}"></td>
							<td><input class="form-control" name="options[{{ $value }}][label]" type="text" value="{{{ $label }}}" placeholder="{{{ trans('platform/attributes::form.option.label') }}}"></td>
							<td>
								<button class="btn btn-md btn-default" data-option-add><i class="fa fa-plus"></i></button>

								<button class="btn btn-md btn-default" data-option-remove><i class="fa fa-trash-o"></i></button>
							</td>
						</tr>
						@endforeach
						<tr data-clonable>
							<td><i data-option-move class="fa fa-arrows"></i></td>
							<td><input class="form-control" name="options[0][value]" type="text" placeholder="{{{ trans('platform/attributes::form.option.value') }}}"></td>
							<td><input class="form-control" name="options[0][label]" type="text" placeholder="{{{ trans('platform/attributes::form.option.label') }}}"></td>
							<td>
								<button class="btn btn-md btn-default" data-option-add><i class="fa fa-plus"></i></button>

								<button class="btn btn-md btn-default" data-option-remove><i class="fa fa-trash-o"></i></button>
							</td>
						</tr>
					</tbody>
				</table>

			</div>

			<div class="hide" data-no-options>

				<div class="jumbotron">
					<h4 class="text-center">The selected attribute type, doesn't allow options.</h4>
				</div>

			</div>

		</div>

	</div>

	{{-- Form actions --}}
	<div class="row">

		<div class="col-lg-12 text-right">

			{{-- Form actions --}}
			<div class="form-group">

				<button class="btn btn-success" type="submit">{{{ trans('button.save') }}}</button>

				<a class="btn btn-default" href="{{{ URL::toAdmin('attributes') }}}">{{{ trans('button.cancel') }}}</a>

				@if ($attribute->exists)
				<a class="btn btn-danger" data-toggle="modal" data-target="modal-confirm" href="{{ URL::toAdmin("attributes/{$attribute->id}/delete") }}">{{{ trans('button.delete') }}}</a>
				@endif

			</div>

		</div>

	</div>

</form>

@stop
