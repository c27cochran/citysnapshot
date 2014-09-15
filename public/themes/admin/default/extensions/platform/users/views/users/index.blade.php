@extends('layouts/default')

{{-- Page title --}}
@section('title')
	@parent
	: {{{ trans('platform/users::users/general.title') }}}
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
		var dg = $.datagrid('main', '.data-grid', '.data-grid_pagination', '.data-grid_applied', {
			loader: '.loading',
			scroll: '.data-grid',
			callback: function()
			{
				$('#checkAll').prop('checked', false);

				$('#actions').prop('disabled', true);
			}
		});

		$(document).on('click', '#checkAll', function()
		{
			$('input:checkbox').not(this).not('[disabled]').prop('checked', this.checked);

			var status = $('input[name="entries[]"]:checked').length > 0;

			$('#actions').prop('disabled', ! status);
		});

		$(document).on('click', 'input[name="entries[]"]', function()
		{
			var status = $('input[name="entries[]"]:checked').length > 0;

			$('#actions').prop('disabled', ! status);
		});

		$(document).on('click', '[data-action]', function(e)
		{
			e.preventDefault();

			var action = $(this).data('action');

			var entries = $.map($('input[name="entries[]"]:checked'), function(e, i)
			{
				return +e.value;
			});

			$.ajax({
				type: 'POST',
				url: '{{ URL::toAdmin('users') }}',
				data: {
					action : action,
					entries: entries
				},
				success: function(response)
				{
					dg.refresh();
				}
			});
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

	<h1>{{{ trans('platform/users::users/general.title') }}}</h1>

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

			<div class="btn-group text-left">

				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
					{{{ trans('general.filters') }}} <span class="caret"></span>
				</button>

				<ul class="dropdown-menu" role="menu">
					<li><a href="#" data-grid="main" data-reset>{{{ trans('general.show_all') }}}</a></li>
					<li><a href="#" data-grid="main" data-filter="activated:1" data-label="activated::{{{ trans('platform/users::users/general.all_activated') }}}" data-reset>{{{ trans('platform/users::users/general.all_activated') }}}</a></li>
					<li><a href="#" data-grid="main" data-filter="activated:0" data-label="activated::{{{ trans('platform/users::users/general.all_deactivated') }}}" data-reset>{{{ trans('platform/users::users/general.all_deactivated') }}}</a></li>
				</ul>

			</div>

			<div class="form-group has-feedback">

				<input name="filter" type="text" placeholder="{{{ trans('general.search') }}}" class="form-control">

				<span class="glyphicon fa fa-search form-control-feedback"></span>

			</div>

			<a class="btn btn-primary" href="{{ URL::toAdmin('users/create') }}"><i class="fa fa-plus"></i> {{{ trans('button.create') }}}</a>

		</form>

	</div>

</div>

<br />

<table data-source="{{ URL::toAdmin('users/grid') }}" data-grid="main" class="data-grid table table-striped table-bordered table-hover">
	<thead>
		<tr>
			<th><input type="checkbox" name="checkAll" id="checkAll"></th>
			<th data-sort="name" class="col-md-4 sortable">{{{ trans('platform/users::users/table.name') }}}</th>
			<th data-sort="email" class="col-md-3 sortable">{{{ trans('platform/users::users/table.email') }}}</th>
			<th data-sort="activated" class="col-md-2 sortable">{{{ trans('platform/users::users/table.activated') }}}</th>
			<th data-sort="created_at" class="col-md-3 sortable">{{{ trans('platform/users::users/table.created_at') }}}</th>
		</tr>
	</thead>
	<tbody></tbody>
</table>

{{-- Data Grid : Pagination --}}
<div class="data-grid_pagination" data-grid="main"></div>

@include('platform/users::users/grid/results')
@include('platform/users::users/grid/pagination')
@include('platform/users::users/grid/filters')
@include('platform/users::users/grid/no_results')

@stop
