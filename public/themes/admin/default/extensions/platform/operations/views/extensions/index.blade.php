@extends('layouts/default')

{{-- Page title --}}
@section('title')
	@parent
	: {{{ trans('platform/operations::extensions/general.title') }}}
@stop

{{-- Queue assets --}}
{{ Asset::queue('underscore', 'underscore/js/underscore.js', 'jquery') }}
{{ Asset::queue('data-grid', 'cartalyst/js/data-grid.js', 'underscore') }}
{{ Asset::queue('moment', 'moment/js/moment.js') }}

{{-- Inline scripts --}}
@section('scripts')
@parent
<script>
	jQuery(document).ready(function($)
	{
		$.datagrid('main', '.data-grid', '.data-grid_pagination', '.data-grid_applied', {
			loader: '.loading',
			scroll: '.data-grid'
		});
	});
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

	<h1>{{{ trans('platform/operations::extensions/general.title') }}}</h1>

</div>

<div class="row">

	<div class="col-lg-7">

		{{-- Data Grid : Applied Filters --}}
		<div class="data-grid_applied" data-grid="main"></div>

	</div>

	<div class="col-lg-5 text-right">

		<form method="post" action="" accept-charset="utf-8" data-search data-grid="main" class="form-inline" role="form">

			<div class="form-group">

				<div class="loading"></div>

			</div>

			<div class="form-group has-feedback">

				<input name="filter" type="text" placeholder="{{{ trans('general.search') }}}" class="form-control">

				<span class="glyphicon fa fa-search form-control-feedback"></span>

			</div>

			<a class="btn btn-primary" href="{{ URL::toAdmin('operations/workshop') }}"><i class="fa fa-plus"></i> {{{ trans('button.create') }}}</a>

		</form>

	</div>

</div>

<br />

<table data-source="{{ URL::toAdmin('operations/extensions/grid') }}" data-grid="main" class="data-grid table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th data-sort="name" class="col-md-8 sortable">{{{ trans('platform/operations::extensions/table.name') }}}</th>
			<th data-sort="slug" class="col-md-2 sortable">{{{ trans('platform/operations::extensions/table.slug') }}}</th>
			<th data-sort="version" class="col-md-2 sortable">{{{ trans('platform/operations::extensions/table.version') }}}</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>

{{-- Data Grid : Pagination --}}
<div class="data-grid_pagination" data-grid="main"></div>

@include('platform/operations::extensions/grid/results')
@include('platform/operations::extensions/grid/pagination')
@include('platform/operations::extensions/grid/filters')
@include('platform/operations::extensions/grid/no_results')

@stop
