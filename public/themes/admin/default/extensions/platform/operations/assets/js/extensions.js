$(document.body).on('change', '#migrations-form input[name="seeder"]', function(e)
{
	if ($(this).prop('checked'))
	{
		$('#migrations-form input[name="seeder_count"]').prop('disabled', false);
	}
	else
	{
		$('#migrations-form input[name="seeder_count"]').prop('disabled', true);
	}
});

$('#migrations-form').find('input')

var fetchData = function()
{
	$.ajax({
		url: url+'/resources',
		success: function(response)
		{
			var migrations = _.template($('#listTemplate').html(), {items: response.migrations});
			var seeders = _.template($('#listSeederTemplate').html(), {items: response.seeders});
			var controllers = _.template($('#listLabelTemplate').html(), {items: response.controllers});
			var models = _.template($('#listTemplate').html(), {items: response.models});
			var widgets = _.template($('#listTemplate').html(), {items: response.widgets});
			var datagrids = _.template($('#listLabelTemplate').html(), {items: response.datagrids});
			var repositories = _.template($('#listTemplate').html(), {items: response.repositories});

			$('.table.migrations tbody').html(migrations);
			$('.table.seeders tbody').html(seeders);
			$('.table.controllers tbody').html(controllers);
			$('.table.models tbody').html(models);
			$('.table.widgets tbody').html(widgets);
			$('.table.datagrids tbody').html(datagrids);
			$('.table.repositories tbody').html(repositories);
		}
	});
};

fetchData();

$(document.body).on('click', '#modal-scaffold .checkAll', function()
{
	$('#modal-scaffold').find('input[type="checkbox"]').not($(this)).prop('checked', $(this).prop('checked'));
});

$('.modal').on('show.bs.modal', function()
{
	$('select.regular').selectize();
	$('select.create').selectize({
		create: true
	});
});

$(document.body).on('click', '.dump-autoloads', function(e)
{
	e.preventDefault();

	var self = this;

	$(this).text('Dump Autoloads ');

	$('<i>').attr({
		class: 'fa fa-spinner fa-spin',
	}).appendTo($(this));

	$.ajax({
		url: url+'/autoloads',
		type: 'post',
		data: {
			slug: $(this).data('slug')
		},
		success: function(response)
		{
			$(self).text('Dump Autoloads').find('i').remove();
		}
	});
});

$(document.body).on('click', '.publish-themes', function(e)
{
	e.preventDefault();

	var self = this;

	$(this).text('Publish Theme ');

	$('<i>').attr({
		class: 'fa fa-spinner fa-spin',
	}).appendTo($(this));

	$.ajax({
		url: url+'/publish',
		type: 'post',
		data: {
			slug: $(this).data('slug')
		},
		success: function(response)
		{
			$(self).text('Publish Theme').find('i').remove();
		}
	});
});

var migrationTemplate = _.template($('#createMigrationTemplate').html());
var seederTemplate = _.template($('#seederTemplate').html());

var controllerTemplate = _.template($('#controllerTemplate').html());
var modelTemplate = _.template($('#modelTemplate').html());
var repositoryTemplate = _.template($('#repositoryTemplate').html());
var widgetTemplate = _.template($('#widgetTemplate').html());
var datagridTemplate = _.template($('#datagridTemplate').html());
var scaffoldTemplate = _.template($('#scaffoldTemplate').html());

$('#modal-controller').find('.modal-content').html(controllerTemplate);
$('#modal-model').find('.modal-content').html(modelTemplate);
$('#modal-widget').find('.modal-content').html(widgetTemplate);
$('#modal-repository').find('.modal-content').html(repositoryTemplate);
$('#modal-datagrid').find('.modal-content').html(datagridTemplate);
$('#modal-scaffold').find('.modal-content').html(scaffoldTemplate);

$('#modal-migration').find('.modal-content').html(migrationTemplate);
$('#modal-seeder').find('.modal-content').html(seederTemplate);

$('#modal-migration').on('hidden.bs.modal', function(e)
{
	$(this).find('.modal-content').html(migrationTemplate);
});

$('#modal-seeder').on('hidden.bs.modal', function(e)
{
	$(this).find('.modal-content').html(seederTemplate);
});

$('#modal-controller').on('hidden.bs.modal', function(e)
{
	$(this).find('.modal-content').html(controllerTemplate);
});

$('#modal-model').on('hidden.bs.modal', function(e)
{
	$(this).find('.modal-content').html(modelTemplate);
});

$('#modal-widget').on('hidden.bs.modal', function(e)
{
	$(this).find('.modal-content').html(widgetTemplate);
});

$('#modal-datagrid').on('hidden.bs.modal', function(e)
{
	$(this).find('.modal-content').html(datagridTemplate);
});

$('#modal-scaffold').on('hidden.bs.modal', function(e)
{
	$(this).find('.modal-content').html(scaffoldTemplate);
});

$(document.body).on('click', '.add', function(e)
{
	e.preventDefault();

	var count = $(this).parents('.modal').find('tbody tr').length;

	var row = _.template($('#migrationsTemplate').html(), {
		index: count,
	});

	$(this).parents('.modal').find('tbody').append(row);

	$(this).parents('.modal').find('tbody select').selectize();
});

$(document.body).on('click', '.remove', function(e)
{
	e.preventDefault();

	$(this).parents('tr:eq(0)').remove();
});

$(document.body).on('submit', '#migrations-form', function(e)
{
	e.preventDefault();

	var data = $('#migrations-form').serialize();

	$('#migrations-form .btn-success').addClass('disabled');

	var seeder = $(this).find('input[name="seeder"]').prop('checked');

	$('#migrations-form .btn-success').text('Create ');

	$('<i>').attr({
		class: 'fa fa-spinner fa-spin',
	}).appendTo($('#migrations-form .btn-success'));

	$.ajax({
		type: 'post',
		url: url+'/migration',
		data: data,
		success: function(response)
		{
			fetchData();

			$('#migrations-form .btn-success').text('Create').find('i').remove();

			$('#modal-migration').modal('hide');
		}
	});

	return false;
});

$(document.body).on('submit', '#controller-form', function(e)
{
	e.preventDefault();

	$('#controller-form .btn-success').addClass('disabled');

	$('<i>').attr({
		class: 'fa fa-spinner fa-spin',
	}).appendTo('#controller-form .save-controller');

	$.ajax({
		type: 'post',
		url: url+'/controller',
		data: $('#controller-form').serialize(),
		success: function(response)
		{
			fetchData();

			$('.save-controller').text('Create').removeClass('disabled');

			$('#modal-controller').modal('hide');
		}
	});

	return false;
});

$(document.body).on('submit', '#model-form', function(e)
{
	e.preventDefault();

	$('#model-form .btn-success').addClass('disabled');

	$('<i>').attr({
		class: 'fa fa-spinner fa-spin',
	}).appendTo('#model-form .save-model');

	$.ajax({
		type: 'post',
		url: url+'/model',
		data: $('#model-form').serialize(),
		success: function(response)
		{
			fetchData();

			$('.save-model').text('Create').removeClass('disabled');

			$('#modal-model').modal('hide');
		}
	});

	return false;
});

$(document.body).on('submit', '#widget-form', function(e)
{
	e.preventDefault();

	$('#widget-form .btn-success').addClass('disabled');

	$('<i>').attr({
		class: 'fa fa-spinner fa-spin',
	}).appendTo('#widget-form .save-widget');

	$.ajax({
		type: 'post',
		url: url+'/widget',
		data: $('#widget-form').serialize(),
		success: function(response)
		{
			fetchData();

			$('.save-widget').text('Create').removeClass('disabled');

			$('#modal-widget').modal('hide');
		}
	});

	return false;
});


$(document.body).on('submit', '#datagrid-form', function(e)
{
	e.preventDefault();

	$('#datagrid-form .btn-success').addClass('disabled');

	$('<i>').attr({
		class: 'fa fa-spinner fa-spin',
	}).appendTo('#datagrid-form .save-datagrid');

	$.ajax({
		type: 'post',
		url: url+'/datagrid',
		data: $('#datagrid-form').serialize(),
		success: function(response)
		{
			fetchData();

			$('.save-datagrid').text('Create').removeClass('disabled');

			$('#modal-datagrid').modal('hide');
		}
	});

	return false;
});


$(document.body).on('click', '.btn.seed', function(e)
{
	e.preventDefault();

	$(this).addClass('disabled');
	$(this).prev('i').removeClass('hidden fa-check').addClass('fa-spinner fa-spin');

	var seeder_class = $(this).data('class');

	var self = this;

	$.ajax({
		type: 'post',
		url: url+'/seed',
		data: {
			seeder: seeder_class
		},
		success: function()
		{
			$(self).prev('i').removeClass('fa-spinner fa-spin').addClass('fa-check');

			$(self).removeClass('disabled');
		},
		error: function(response)
		{
			$(self).prev('i').removeClass('fa-spinner fa-spin').addClass('fa-times');
			$(self).removeClass('disabled');
		}
	});
});

$(document.body).on('submit', '#seeder-form', function(e)
{
	e.preventDefault();

	var table_name = $('input[name="table_name"]').val();
	var records = $('input[name="records"]').val();

	$('.save-seeder').text('Creating ').addClass('disabled');

	$('<i>').attr({
		class: 'fa fa-spinner fa-spin',
	}).appendTo('.save-seeder');

	$.ajax({
		type: 'post',
		url: url+'/seeder',
		data: {
			slug: '{{ $extension->getSlug() }}',
			table: table_name,
			records: records
		},
		success: function()
		{
			fetchData();

			$('.save-seeder').text('Create').removeClass('disabled');

			$('#modal-seeder').find('input').val('');

			$('#modal-seeder').modal('hide');
		},
		error: function(response)
		{
			$('#seeder-form').find('.form-group').addClass('has-error');
			$('#seeder-form').find('.help-block').text(response.responseJSON.error.message);
			$('.save-seeder').removeClass('disabled');
			$('.save-seeder').find('i').removeClass('fa-spin fa-spinner').addClass('fa-times');
		}
	});
});


$(document.body).on('submit', '#scaffold-form', function(e)
{
	e.preventDefault();

	var table_name      = $('input[name="table_name"]').val();
	var records         = $('input[name="records"]').val();
	var data            = $('#scaffold-form').serialize();
	var datagrid        = $('#scaffold-form').find('input[name="datagrid"]').prop('checked');
	var form            = $('#scaffold-form').find('input[name="form"]').prop('checked');
	var adminController = $('#scaffold-form').find('input[name="admin_controller"]').prop('checked');
	var seeder          = $('#scaffold-form').find('input[name="seeder"]').prop('checked');
	var name            = $('#scaffold-form').find('input[name="name"]').val();

	$('.save-scaffold').text('Creating ').addClass('disabled');

	$('<i>').attr({
		class: 'fa fa-spinner fa-spin',
	}).appendTo('.save-scaffold');

	$.ajax({
		type: 'post',
		url: url+'/scaffold',
		data: data,
		success: function(response)
		{
			fetchData();

			$('#modal-scaffold').modal('hide');

			if (response.migration)
			{
				$('#modal-migration').modal('show');

				$('#migrations-form').find('input[name="table"]').val(response.table);
				$('#migrations-form').find('input[name="table"]').prop('readonly', true);

				$('<input>').attr({
					type: 'hidden',
					name: 'model',
					value: response.lower_model,
				}).appendTo('#migrations-form');

				$('<input>').attr({
					type: 'hidden',
					name: 'option_admin_controller',
					value: adminController,
				}).appendTo('#migrations-form');

				$('<input>').attr({
					type: 'hidden',
					name: 'option_datagrid',
					value: datagrid,
				}).appendTo('#migrations-form');

				$('<input>').attr({
					type: 'hidden',
					name: 'option_form',
					value: form,
				}).appendTo('#migrations-form');
			}
		}
	});
});


$(document.body).on('submit', '#repository-form', function(e)
{
	e.preventDefault();

	$('#repository-form .btn-success').addClass('disabled');

	$('<i>').attr({
		class: 'fa fa-spinner fa-spin',
	}).appendTo('#repository-form .save-repository');

	$.ajax({
		type: 'post',
		url: url+'/repository',
		data: $('#repository-form').serialize(),
		success: function(response)
		{
			fetchData();

			$('.save-repository').text('Create').removeClass('disabled');

			$('#modal-repository').modal('hide');
		}
	});

	return false;
});
