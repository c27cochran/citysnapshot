<script type="text/template" id="datagridTemplate">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Create DataGrid</h4>
	</div>

	<form id="datagrid-form">

		<div class="modal-body">

			<div class="row">

				<div class="col-md-6">
					<input type="text" name="name" class="form-control" placeholder="DataGrid Name" required>
				</div>

				<div class="col-md-6">
					<select name="theme" class="form-control regular" required>
						<option>Theme</option>
						@foreach($themeLocations as $theme)
							<option value="{{ $theme }}">{{ $theme }}</option>
						@endforeach
					</select>
				</div>

			</div>

			<br>

			<div class="row">
				<div class="col-md-12">
					<input type="text" name="view" class="form-control" placeholder="View Name" required>
				</div>
			</div>

		</div>

		<div class="modal-footer">
			<button type="submit" class="btn btn-success save-datagrid">Create</button>
		</div>

	</form>
</script>
