<script type="text/template" id="listTemplate">

<% if (items.length == 0) { %>

	<tr>
		<td>-</td>
	</tr>

<% } %>

<% _.each(items, function(item) { %>

	<tr>
		<td>
			<%= item.class %>
		</td>
	</tr>

<% }); %>

</script>

<script type="text/template" id="listLabelTemplate">

<% if (items.length == 0) { %>

	<tr>
		<td>-</td>
	</tr>

<% } %>

<% _.each(items, function(item) { %>

	<tr>
		<td>
			<span class="label label-default"><%= item.location %></span> <%= item.class %>
		</td>
	</tr>

<% }); %>

</script>

<script type="text/template" id="listSeederTemplate">

<% if (items.length == 0) { %>

	<tr>
		<td>-</td>
	</tr>

<% } %>

<% _.each(items, function(item) { %>

	<tr>
		<td>
			<%= item.class %> <i class="hidden fa fa-spinner fa-spin"></i> <a href="#" data-class="<%= item.namespace + item.class %>" class="pull-right btn btn-default btn-xs seed">run</a>
		</td>
	</tr>

<% }); %>

</script>
