<!-- BEGIN NEUOEFFENTLICHEGALERIE -->
<script type="text/javascript">
$(document).ready(function() {
    var options = {
        target:        '#neueoeffentlichegalerieformdiv',
        replaceTarget: 	true,
        success:       showResponse
    };
    $('#neueoeffentlichegalerieform').ajaxForm(options);
});

function showResponse(responseText, statusText, xhr, $form)
{
	$('#galerieuebersicht').load('oeffentlichegalerien.html');
};
</script>
<div id="neueoeffentlichegalerieformdiv">
<h3>Neue Galerie anlegen</h3>
<p>Legen Sie hier eine neue öffentliche Galerie an.</p>
<form{neueoeffentlichegalerieform_attributes}>
<table>
	<tr>
		<td>{neueoeffentlichegalerieform_galeriename_label}</td>
	</tr>
	<tr>
		<td>{neueoeffentlichegalerieform_galeriename_html}</td>
	</tr>
	<tr>
		<td>{neueoeffentlichegalerieform_submit_label}</td>
	</tr>
	<tr>
		<td>{neueoeffentlichegalerieform_submit_html}</td>
	</tr>
	<tr>
		<td id="error" class="error"><!-- BEGIN neueoeffentlichegalerieform_error_loop -->
		{neueoeffentlichegalerieform_error}<br />
		<!-- END neueoeffentlichegalerieform_error_loop --></td>
	</tr>
</table>
</form>
</div>
<!-- END NEUOEFFENTLICHEGALERIE -->
