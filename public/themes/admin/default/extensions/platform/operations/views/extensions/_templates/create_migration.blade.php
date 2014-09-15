<script type="text/template" id="createMigrationTemplate">

<form id="migrations-form" action="{{ Request::fullUrl() }}" method="post" accept-char="UTF-8" autocomplete="off">

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Generating Migration</h4>
	</div>

	<div class="modal-body">

		<div class="row">

			<div class="col-md-12">
				<div class="form-group">
					<p><strong>Table</strong></p>

					<input id="table" name="table" type="input" class="form-control" placeholder="Table Name" required>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="increments" checked> Increments
							</label>
						</div>
					</div>

					<div class="col-md-4">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="timestamps" checked> Timestamps
							</label>
						</div>
					</div>

					<div class="col-md-2">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="seeder"> Seeder
							</label>
						</div>
					</div>

					<div class="col-md-2">
					<input type="text" name="seeder_count" class="form-control" placeholder="#" disabled>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="col-md-3">Field</th>
									<th class="col-md-3">Type</th>
									<th class="col-md-3">Default</th>
									<th class="col-md-1">Nullable</th>
									<th class="col-md-1">Unsigned</th>
									<th class="col-md-1"></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input name="rows[0][field]" type="text" class="form-control" required></td>
									<td>
										<select name="rows[0][type]" id="" class="form-control regular" required>
											<option value="" disabled selected>Select</option>
											<option value="increments">increments</option>
											<option value="bigIncrements">bigIncrements</option>
											<option value="char">char</option>
											<option value="string">string</option>
											<option value="text">text</option>
											<option value="mediumText">mediumText</option>
											<option value="longText">longText</option>
											<option value="integer">integer</option>
											<option value="bigInteger">bigInteger</option>
											<option value="mediumInteger">mediumInteger</option>
											<option value="tinyInteger">tinyInteger</option>
											<option value="smallInteger">smallInteger</option>
											<option value="float">float</option>
											<option value="double">double</option>
											<option value="decimal">decimal</option>
											<option value="boolean">boolean</option>
											<option value="date">date</option>
											<option value="dateTime">dateTime</option>
											<option value="time">time</option>
											<option value="timestamp">timestamp</option>
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
			</div>

		</div>

	</div>

	<div class="modal-footer">
		<button class="btn btn-success run" value="run" type="submit">Create</button>
		<a class="btn btn-default" href="#" data-dismiss="modal">{{{ trans('button.cancel') }}}</a>
	</div>

</form>

</script>























<script type="text/template" id="createMigrationScaffoldTemplate">

<form id="migrations-scaffold-form" action="{{ Request::fullUrl() }}" method="post" accept-char="UTF-8">

	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Generating Scaffold Migration</h4>
	</div>

	<div class="modal-body">

		<div class="row">

			<div class="col-md-12">
				<div class="form-group">
					<p><strong>Table</strong></p>

					<input id="table" name="table" type="input" class="form-control" placeholder="Table Name" required readonly>
				</div>

				<div class="row">
					<div class="col-md-4">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="increments" checked> Increments
							</label>
						</div>
					</div>

					<div class="col-md-4">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="timestamps" checked> Timestamps
							</label>
						</div>
					</div>

					<div class="col-md-4">
						<div class="checkbox">
							<label>
								<input type="checkbox" name="seeder"> Seeder
							</label>
						</div>
					</div>
				</div>

				<div class="row">
					<div class="col-md-12">
						<table class="table table-hover">
							<thead>
								<tr>
									<th class="col-md-3">Field</th>
									<th class="col-md-3">Type</th>
									<th class="col-md-3">Default</th>
									<th class="col-md-1">Nullable</th>
									<th class="col-md-1">Unsigned</th>
									<th class="col-md-1"></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td><input name="rows[0][field]" type="text" class="form-control" required></td>
									<td>
										<select name="rows[0][type]" id="" class="form-control regular" required>
											<option value="" disabled selected>Select</option>
											<option value="increments">increments</option>
											<option value="bigIncrements">bigIncrements</option>
											<option value="char">char</option>
											<option value="string">string</option>
											<option value="text">text</option>
											<option value="mediumText">mediumText</option>
											<option value="longText">longText</option>
											<option value="integer">integer</option>
											<option value="bigInteger">bigInteger</option>
											<option value="mediumInteger">mediumInteger</option>
											<option value="tinyInteger">tinyInteger</option>
											<option value="smallInteger">smallInteger</option>
											<option value="float">float</option>
											<option value="double">double</option>
											<option value="decimal">decimal</option>
											<option value="boolean">boolean</option>
											<option value="date">date</option>
											<option value="dateTime">dateTime</option>
											<option value="time">time</option>
											<option value="timestamp">timestamp</option>
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
			</div>

		</div>

	</div>

	<div class="modal-footer">
		<button class="btn btn-success run" value="run" type="submit">Create</button>
		<a class="btn btn-default" href="#" data-dismiss="modal">{{{ trans('button.cancel') }}}</a>
	</div>

</form>

</script>
