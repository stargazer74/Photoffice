<!-- BEGIN NEUKUNDE -->
<script type="text/javascript">
$(document).ready(function() { 
    var options = { 
        target:        '#formdiv',
        replaceTarget: 	true,
        success:       showKundeResponse
    }; 
    $('#neukundeform').ajaxForm(options);
}); 
 
function showKundeResponse(responseText, statusText, xhr, $form)  
{ 
	for (i = 1; i <= 1; i++)
	{
		$('#break').remove();
	}
	if($('#error').is(':empty'))
	{
		alert('Daten wurden eingetragen.');
	}
};
</script>
<br id="break" />
<div id ="formdiv" class="border padding_10">
	<p>Hier können Sie einen Neukunden anlegen.</p>
	<form {neukundeform_attributes}>
		<table>
			<tr>
				<td>{neukundeform_kundennummer_label}</td>
				<td></td>
			</tr>
			<tr>
				<td>{neukundeform_kundennummer_html}</td>
				<td></td>
			</tr>
			<tr>
				<td>{neukundeform_firma_label}</td>
				<td></td>
			</tr>
			<tr>
				<td>{neukundeform_firma_html}</td>
				<td></td>
			</tr>
			<tr>
				<td>{neukundeform_vorname_label}</td>
				<td>{neukundeform_name_label}</td>
			</tr>
			<tr>
				<td>{neukundeform_vorname_html}</td>
				<td>{neukundeform_name_html}</td>
			</tr>
			<tr>
				<td>{neukundeform_strasse_label}</td>
				<td>{neukundeform_hausnummer_label}</td>
			</tr>
			<tr>
				<td>{neukundeform_strasse_html}</td>
				<td>{neukundeform_hausnummer_html}</td>
			</tr>
			<tr>
				<td>{neukundeform_plz_label}</td>
				<td>{neukundeform_stadt_label}</td>
			</tr>
			<tr>
				<td>{neukundeform_plz_html}</td>
				<td>{neukundeform_stadt_html}</td>
			</tr>
			<tr>
				<td>{neukundeform_telefon_label}</td>
				<td>{neukundeform_mail_label}</td>
			</tr>
			<tr>
				<td>{neukundeform_telefon_html}</td>
				<td>{neukundeform_mail_html}</td>
			</tr>
			<tr>
				<td colspan="2">{neukundeform_submit_label}</td>
			</tr>
			<tr>
				<td colspan="2">{neukundeform_submit_html}</td>
			</tr>
			<tr>
				<td id="error" colspan="2" class="error"><!-- BEGIN neukundeform_error_loop -->{neukundeform_error}<br /><!-- END neukundeform_error_loop --></td>
			</tr>
		</table>
	</form>
</div>
<!-- END NEUKUNDE -->