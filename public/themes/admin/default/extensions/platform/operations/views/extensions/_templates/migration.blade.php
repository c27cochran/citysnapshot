<script type="text/template" id="migrationsTemplate">

<tr>
	<td><input name="rows[<%= index %>][field]" type="text" class="form-control" required></td>
	<td>
		<select name="rows[<%= index %>][type]" id="" class="form-control" required>
			<option disabled selected>Select</option>
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
			<option value="unsignedInteger">unsignedInteger</option>
			<option value="unsignedBigInteger">unsignedBigInteger</option>
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
	<td><input name="rows[<%= index %>][default]" type="type" class="form-control"></td>
	<td><input name="rows[<%= index %>][nullable]" type="checkbox" value="nullable"></td>
	<td><input name="rows[<%= index %>][unsigned]" type="checkbox" value="unsigned"></td>
	<td><a href="#" class="btn btn-danger remove"><i class="fa fa-trash-o"></i></a></td>
</tr>

</script>
