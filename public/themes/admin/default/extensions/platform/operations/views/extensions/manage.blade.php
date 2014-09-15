@extends('layouts/default')

{{-- Page title --}}
@section('title')
	@parent
	: {{{ trans('platform/operations::extensions/general.manage') }}}
@stop

{{ Asset::queue('extensions', 'platform/operations::css/extensions.css') }}
{{ Asset::queue('selectize', 'selectize/css/selectize.css', 'styles') }}

{{ Asset::queue('underscore', 'underscore/js/underscore.js', 'jquery') }}
{{ Asset::queue('extensions-modals', 'platform/operations::js/modals.js', 'jquery') }}
{{ Asset::queue('extensions', 'platform/operations::js/extensions.js', 'jquery') }}
{{ Asset::queue('selectize', 'selectize/js/selectize.js', 'jquery') }}

{{-- Inline scripts --}}
@section('scripts')
@parent
@stop

{{-- Inline styles --}}
@section('styles')
@parent
<script>
	var url = '{{ URL::toAdmin("operations/extensions/{$extension->getSlug()}/") }}';
</script>
@stop

{{-- Page content --}}
@section('content')

{{-- Page header --}}
<div class="page-header">
	<h1>{{{ trans('platform/operations::extensions/general.manage') }}} <small>{{{ $extension->name ?: $extension->getSlug() }}}</small><a href="#" class="btn pull-right btn-success" id="create-scaffold">Scaffold</a></h1>
</div>

<div class="row">

	{{-- Dependencies --}}
	<div class="col-lg-6">

		<div class="panel panel-default">

			<div class="panel-heading">
				<h3 class="panel-title">Dependencies</h3>
			</div>

			@if (count($dependencies) == 0)
			<div class="panel-body">
				This extension doesn't have any dependencies.
			</div>
			@else

			<table class="table">
			@foreach ($dependencies as $_extension)
				<tr>
					<td>
						{{{ $_extension->name }}} ({{{ $_extension->getSlug() }}})

						<div class="pull-right">

							@if ($_extension->isInstalled())
								<span class="label label-success">{{{ trans('general.installed') }}}</span>

								@if ($_extension->isEnabled())
								<span class="label label-success">{{{ trans('general.enabled') }}}</span>
								@else
								<span class="label label-warning">{{{ trans('general.disabled') }}}</span>
								@endif
							@else
								<span class="label label-danger">{{{ trans('general.uninstalled') }}}</span>
							@endif

						</div>
					</td>
				</tr>
			@endforeach
			</table>
			@endif

		</div>

		<div class="panel panel-default">

			<div class="panel-heading">
				<h3 class="panel-title">Dependents</h3>
			</div>

			@if (count($dependents) == 0)
			<div class="panel-body">
				This extension doesn't have any dependents.
			</div>
			@else
			<table class="table">
			@foreach ($dependents as $_extension)
				<tr>
					<td>
						{{{ $_extension->name }}} ({{{ $_extension->getSlug() }}})

						<div class="pull-right">

							@if ($_extension->isInstalled())
								<span class="label label-success">{{{ trans('general.installed') }}}</span>

								@if ($_extension->isEnabled())
								<span class="label label-success">{{{ trans('general.enabled') }}}</span>
								@else
								<span class="label label-warning">{{{ trans('general.disabled') }}}</span>
								@endif
							@else
								<span class="label label-danger">{{{ trans('general.uninstalled') }}}</span>
							@endif

						</div>
					</td>
				</tr>
			@endforeach
			</table>
			@endif

		</div>

		<div class="panel panel-default">

			<div class="panel-heading">
				<h3 class="panel-title">Manage Extension</h3>
			</div>

			<div class="panel-body">

				{{-- Check if the extension is installed --}}
				@if ($extension->isInstalled())

					{{-- Check if the extension is enabled --}}
					@if ($extension->isEnabled())

						{{-- Allow an extension to be disabled --}}
						@if ($extension->canDisable())
							<a href="{{ URL::toAdmin("operations/extensions/{$extension->getSlug()}/disable") }}" class="btn btn-primary">{{{ trans('button.disable') }}}</a>
						@else
							<span class="btn btn-primary" disabled="disabled">{{{ trans('button.disable') }}}</span>
						@endif

					{{-- Check if the extension can be enabled --}}
					@else
						@if ($extension->canEnable())
							<a href="{{ URL::toAdmin("operations/extensions/{$extension->getSlug()}/enable") }}" class="btn btn-info">{{{ trans('button.enable') }}}</a>
						@else
							<span class="btn btn-info" disabled="disabled">{{{ trans('button.enable') }}}</span>
						@endif
					@endif

					{{-- Check if the extension can be uninstalled --}}
					@if ($extension->canUninstall())
						<a href="{{ URL::toAdmin("operations/extensions/{$extension->getSlug()}/uninstall") }}" class="btn btn-danger">{{{ trans('button.uninstall') }}}</a>
					@else
						<span class="btn btn-danger" disabled="disabled">{{{ trans('button.uninstall') }}}</span>
					@endif

				@else

					{{-- Allow an extension to be installed --}}
					@if ($extension->canInstall())
						<a href="{{ URL::toAdmin("operations/extensions/{$extension->getSlug()}/install") }}" class="btn btn-success">{{{ trans('button.install') }}}</a>
					@else
						<span class="btn btn-success" disabled="disabled">{{{ trans('button.install') }}}</span>
					@endif

				@endif

				<div class="pull-right">
					<a href="#" data-slug="{{ $extension->getSlug() }}" class="btn btn-default dump-autoloads">Dump Autoloads</a>

					<a href="#" data-slug="{{ $extension->getSlug() }}" class="btn btn-default publish-themes">Publish Theme</a>
				</div>

			</div>

		</div>

	</div>

	{{-- Components --}}
	<div class="col-lg-6">

		@include('platform/operations::extensions.partials.components')

	</div>

</div>

@include('platform/operations::extensions.partials.modals')

@include('platform/operations::extensions._templates.migration')
@include('platform/operations::extensions._templates.create_migration')
@include('platform/operations::extensions._templates.seeder')
@include('platform/operations::extensions._templates.list')
@include('platform/operations::extensions._templates.controller')
@include('platform/operations::extensions._templates.model')
@include('platform/operations::extensions._templates.repository')
@include('platform/operations::extensions._templates.widget')
@include('platform/operations::extensions._templates.datagrid')
@include('platform/operations::extensions._templates.scaffold')

@stop
