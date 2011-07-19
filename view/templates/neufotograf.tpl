<!-- BEGIN NEUFOTOGRAF -->
<script type="text/javascript">
$(document).ready(function() { 
    var options = { 
        target:        '#formdiv',
        replaceTarget: 	true,
        success:       showResponse
    }; 
    $('#neufotografform').ajaxForm(options);
}); 
 
function showResponse(responseText, statusText, xhr, $form)  
{ 
	for (i = 1; i <= 1; i++)
	{
		$('#break').remove();
	}
	alert('Fotograf wurde eingetragen.');
};
</script>
<br id="break" />
<div id ="formdiv" class="border padding_10">
	<p>Hier können Sie einen neuen Fotografen anlegen.</p>
	<form {neufotografform_attributes}>
		<table>
			<tr>
				<td>{neufotografform_vorname_label}</td>
				<td>{neufotografform_nachname_label}</td>
			</tr>
			<tr>
				<td>{neufotografform_vorname_html}</td>
				<td>{neufotografform_nachname_html}</td>
			</tr>
			<tr>
				<td>{neufotografform_loginname_label}</td>
				<td>{neufotografform_passwort_label}</td>
			</tr>
			<tr>
				<td>{neufotografform_loginname_html}</td>
				<td>{neufotografform_passwort_html}</td>
			</tr>
			<tr>
				<td colspan="2">{neufotografform_submit_html}</td>
			</tr>
			<tr>
				<td id="error" colspan="2" class="error">
				<!-- BEGIN neufotografform_error_loop -->
				{neufotografform_error}<br />
				<!-- END neufotografform_error_loop -->
				</td>
			</tr>
		</table>
	</form>
</div>
<!-- END NEUFOTOGRAF -->