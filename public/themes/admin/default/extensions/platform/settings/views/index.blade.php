@extends('layouts/default')

{{-- Page title --}}
@section('title')
	@parent
	: {{ trans('platform/settings::general.title') }}
@stop

{{-- Queue assets --}}
{{ Asset::queue('bootstrap.popover', 'js/bootstrap/popover.js') }}

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

	<h1>{{{ trans('platform/settings::general.title') }}}</h1>

</div>

<form class="form-horizontal" action="{{ Request::fullUrl() }}" method="POST" accept-char="UTF-8">

	{{-- CSRF Token --}}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<ul class="nav nav-tabs">
	@foreach ($namespaces as $_namespace)
		<li class="{{ $_namespace['slug'] == $namespace['slug'] ? 'active' : '' }}">
			<a href="{{ URL::toAdmin("settings/edit/{$_namespace['slug']}") }}">{{ $_namespace['name'] }}</a>
		</li>
	@endforeach
	</ul>

	{{-- Tabs content --}}
	<div class="tab-content tab-bordered">

		@if ($namespace['groups'])

			@foreach ($namespace['groups'] as $i => $group)
			<fieldset>
				<legend>{{ $group['name'] }}</legend>
				@if ($group['settings'])
					@each('platform/settings::form', $group['settings'], 'setting')
				@else
					<h3>{{ trans('platform/settings::general.no_settings', array('group' => $group['key'], 'namespace' => $namespace['key'])) }}</h3>
				@endif
				</fieldset>
			@endforeach

		@else
			<h3>{{ trans('platform/settings::general.no_groups', array('namespace' => $namespace['key'])) }}</h3>
		@endif

		{{-- Form actions --}}
		<div class="form-group">

			<div class="col-lg-offset-3 col-lg-9">
				<button class="btn btn-success" type="submit">{{{ trans('button.save') }}}</button>
			</div>

		</div>

	</div>

</form>

@stop
