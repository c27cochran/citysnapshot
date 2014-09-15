$(document.body).on('click', 'a[id^="create-"]', function(e)
{
	e.preventDefault();

	var id = $(this).attr('id').replace('create-', '');

	$('#modal-'+id).modal({
		show: true
	});

	if (id === 'scaffold')
	{
		$('<input>').attr({
			type: 'hidden',
			name: 'scaffold',
			value: true,
		}).appendTo('#migrations-form');
	}
});
