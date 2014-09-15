jQuery(document).ready(function($)
{
	$('[data-selectize="create"]').selectize({ create: true });

	optionsChanger();

	$(document).on('change', '#type', function() { optionsChanger(); });

	function optionsChanger()
	{
		if ($('#type').find(':selected').data('allow-options'))
		{
			$('[data-options]').removeClass('hide');
			$('[data-no-options]').addClass('hide');
		}
		else
		{
			$('[data-options]').addClass('hide');
			$('[data-no-options]').removeClass('hide');
		}
	};

	$(document).on('click', '[data-option-add]', function(e)
	{
		e.preventDefault();

		var totalRows = $('table tbody tr').length;

		var $tr = $(this).closest('[data-clonable]');

		var $clone = $tr.clone(true);

		$clone.find(':text').val('');

		$clone.find('input').each(function()
		{
			var name = $(this).attr('name');

			var current = name.match(/\d+/)

			$(this).attr('name', name.replace(current, totalRows + 1));
		});

		$tr.after($clone);
	});

	$(document).on('click', '[data-option-remove]', function(e)
	{
		e.preventDefault();

		var totalRows = $('table tbody tr').length;

		if (totalRows >= 2)
		{
			$(this).closest('tr').remove();
		}
	});

	// Sortable rows
	$('table').sortable({
		handle: '[data-option-move]',
		containerSelector: 'table',
		itemPath: '> tbody',
		itemSelector: 'tr',
		nested: true,
		distance: 10,
		placeholder: '<tr><td class="placeholder" colspan="4">Drop here</td></tr>',
	});

	H5F.setup(document.getElementById('attributes-form'));
});
