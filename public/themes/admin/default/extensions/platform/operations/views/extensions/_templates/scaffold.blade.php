<script type="text/template" id="scaffoldTemplate">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		<h4 class="modal-title">Scaffold</h4>
	</div>

	<form id="scaffold-form">

		<div class="modal-body">

			<div class="row">

				<div class="col-md-12">
					<input type="text" name="name" class="form-control" placeholder="Name (ex: post, blog, author, ..)" required>
				</div>

			</div>

			<br>

			<div class="row">
				<div class="col-md-12">

					<div class="checkbox">
						<label>
							<input class="checkAll" type="checkbox"> Check all
						</label>
					</div>

				</div>
			</div>

			<div class="row">
				<div class="col-md-6">

					<strong>Controllers</strong>

					<div class="checkbox">
						<label>
							<input type="checkbox" name="admin_controller"> Admin Controller
						</label>
					</div>

					<div class="checkbox">
						<label>
							<input type="checkbox" name="frontend_controller"> Frontend Controller
						</label>
					</div>

					<strong>Resources</strong>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="model"> Model
						</label>
					</div>

					<div class="checkbox">
						<label>
							<input type="checkbox" name="widget"> Widget
						</label>
					</div>

					<strong>Add/Edit Form</strong>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="form"> Form
						</label>
					</div>

					<strong>Language Files</strong>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="lang"> Language Files
						</label>
					</div>

				</div>

				<div class="col-md-6">

					<strong>Repository</strong>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="repository"> Interface &amp; Repository
						</label>
					</div>

					<strong>Data Grid</strong>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="datagrid"> Data Grid
						</label>
					</div>


					<strong>Database</strong>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="migration"> Migration & Seeder
						</label>
					</div>

					<strong>extension.php</strong>
					<div class="checkbox">
						<label>
							<input type="checkbox" name="boot"> Boot (<small>Add attributes namespace</small>)
						</label>
					</div>

					<div class="checkbox">
						<label>
							<input type="checkbox" name="register"> Register (<small>Add repository binding</small>)
						</label>
					</div>

					<div class="checkbox">
						<label>
							<input type="checkbox" name="routes"> Routes
						</label>
					</div>

					<div class="checkbox">
						<label>
							<input type="checkbox" name="permissions"> Permissions
						</label>
					</div>

					<div class="checkbox">
						<label>
							<input type="checkbox" name="menus"> Menu Item
						</label>
					</div>

				</div>

			</div>

		</div>

		<div class="modal-footer">
			<button type="submit" class="btn btn-success save-scaffold">Next</button>
		</div>

	</form>
</script>
