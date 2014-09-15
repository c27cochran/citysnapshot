<script type="text/template" id="seederTemplate">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Create Seeder</h4>
	</div>

	<form id="seeder-form">

		<div class="modal-body">

			<div class="row">
				<div class="col-md-10">

					<div class="form-group">
						<input type="text" name="table_name" class="form-control" placeholder="Table Name" required>

						<span class="help-block"></span>
					</div>

				</div>
				<div class="col-md-2">
					<input type="text" name="records" class="form-control" placeholder="#" required>
				</div>
			</div>

		</div>

		<div class="modal-footer">
			<button type="submit" class="btn btn-success save-seeder">Create</button>
		</div>

	</form>
</script>
