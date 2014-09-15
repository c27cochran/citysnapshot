<script type="text/template" id="controllerTemplate">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Create Controller</h4>
	</div>

	<form id="controller-form">

		<div class="modal-body">

			<div class="row">
				<div class="col-md-9">
					<input type="text" name="name" class="form-control" placeholder="Controller Name Ex. posts" required>
				</div>
				<div class="col-md-3">
					<select name="location" class="form-control create" required>
						<option value="" disabled selected>Location</option>
						@foreach($controllerLocations as $location)
							<option value="{{ $location }}">{{ $location }}</option>
						@endforeach
					</select>
				</div>
			</div>

		</div>

		<div class="modal-footer">
			<button type="submit" class="btn btn-success save-controller">Create</button>
		</div>

	</form>
</script>
