@extends('layouts/default')

{{-- Page title --}}
@section('title')
	@parent
	: {{{ trans('platform/operations::workshop/general.migration') }}}
@stop

{{-- Queue assets --}}
{{ Asset::queue('validate', 'platform/js/validate.js', 'jquery') }}
{{ Asset::queue('underscore', 'underscore/js/underscore.js', 'jquery') }}
{{ Asset::queue('migrations', 'platform/operations::js/migrations.js', 'jquery') }}

{{-- Inline scripts --}}
@section('scripts')
@parent
<script type="text/javascript">
	H5F.setup(document.getElementById('migrations-form'));

	var url = '{{ URL::toAdmin("operations/extensions/{$extensionSlug}/manage") }}';
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

	<h1>{{{ trans('platform/operations::workshop/migrations.title') }}} <small>Create a new migration <span class="label label-info pull-right">{{ $extensionSlug }}</span></small></h1>

</div>

<form id="migrations-form" action="{{ Request::fullUrl() }}" method="post" accept-char="UTF-8" autocomplete="off">

	{{-- CSRF Token --}}
	<input type="hidden" name="_token" value="{{ csrf_token() }}">

	<br>

	<div class="row">

		<div class="col-md-12">
			<div class="form-group">
				<p><strong>Table</strong></p>

				<input id="table" name="table" type="input" class="form-control" placeholder="Table Name" required>
			</div>

			<div class="form-group">
				<label for="increments">
					Increments
					<input id="increments" name="increments" type="checkbox">
				</label>

				<label for="timestamps">
					Timestamps
					<input id="timestamps" name="timestamps" type="checkbox">
				</label>

				<label for="seeder">
					Seeder
					<input id="seeder" name="seeder" type="checkbox">
				</label>

			</div>

			<p><strong>Fields</strong></p>

			<table class="table table-hover">
				<thead>
					<tr>
						<th>Field</th>
						<th>Type</th>
						<th>Default</th>
						<th>Nullable</th>
						<th>Unsigned</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td><input name="rows[0][field]" type="text" class="form-control" required></td>
						<td>
							<select name="rows[0][type]" id="" class="form-control" required>
								<option value="" disabled selected>Select</option>
								<option value="integer">Integer</option>
								<option value="string">String</option>
								<option value="tinyInteger">Tiny Integer</option>
								<option value="text">Text</option>
							</select>
						</td>
						<td><input name="rows[0][default]" type="type" class="form-control"></td>
						<td><input name="rows[0][nullable]" type="checkbox" value="nullable"></td>
						<td><input name="rows[0][unsigned]" type="checkbox" value="unsigned"></td>
						<td><a href="#" class="btn btn-danger remove"><i class="fa fa-trash-o"></i></a></td>
					</tr>
				</tbody>
			</table>

			<a href="#" class="btn btn-default add">Add Field</a>
		</div>

	</div>

	{{-- Form actions --}}
	<div class="row">

		<div class="col-lg-12 text-right">

			<div class="form-group">

				<button class="btn btn-success" type="submit">{{{ trans('button.save') }}}</button>

				<button class="btn btn-success run" value="run" type="submit">Save &amp; Run</button>

				<a class="btn btn-default" href="{{{ URL::toAdmin('operations') }}}">{{{ trans('button.cancel') }}}</a>

			</div>

		</div>

	</div>

</form>

@include('platform/operations::_templates.migration')

<div class="modal fade" id="modal-migration" tabindex="-1" role="dialog" aria-labelledby="model-migration-label" aria-hidden="true">

	<div class="modal-dialog">

		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Generating Migration</h4>
			</div>

			<div class="modal-body">

				<ul class="list-unstyled">
					<li><i class="fa fa-spinner fa-spin"></i>&nbsp;Generate migration</li>
					<li><i class="fa fa-spinner fa-spin"></i>&nbsp;Run migration</li>
					<li><i class="fa fa-spinner fa-spin"></i>&nbsp;Run seeder - <small>Make sure you update your seeder file before running it.</small></li>
				</ul>

			</div>

			<div class="modal-footer">
				<a href="#" class="btn btn-default pull-left" data-dismiss="modal">Close</a>
				<a href="#" class="btn btn-success disabled run-migration">Run migration <i></i></a>
				<a href="#" class="btn btn-success disabled run-seeder">Run seeder <i></i></a>
			</div>

		</div>

	</div>

</div>


@stop
