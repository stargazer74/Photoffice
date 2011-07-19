<!-- BEGIN STAMMDATEN -->
<script type="text/javascript">

$(document).ready(function() {
    var options = { 
        target:			'#formdiv',
        replaceTarget: 	true,
        success:      	showResponse
    }; 
    $('#firmaform').ajaxForm(options);
});
 
function showResponse(responseText, statusText, xhr, $form)  
{ 
	for (i = 1; i <= 1; i++)
	{
		$('#break').remove();
	}
	alert('Daten wurden geändert');
} 
</script>
<br id="break" />
<div id="formdiv" class="border padding_10">
	<p>Hier können Sie ihre Firmendatenstammdaten ändern.</p>

	<form {firmaform_attributes}>
		<table>
			<tr>
				<td>{firmaform_firmenname_label}</td>
				<td>{firmaform_geschaeftsfuehrer_label}</td>
			</tr>
			<tr>
				<td>{firmaform_firmenname_html}</td>
				<td>{firmaform_geschaeftsfuehrer_html}</td>
			</tr>
			<tr>
				<td>{firmaform_strasse_label}</td>
				<td>{firmaform_hausnummer_label}</td>
			</tr>
			<tr>
				<td>{firmaform_strasse_html}</td>
				<td>{firmaform_hausnummer_html}</td>
			</tr>
			<tr>
				<td>{firmaform_plz_label}</td>
				<td>{firmaform_stadt_label}</td>
			</tr>
			<tr>
				<td>{firmaform_plz_html}</td>
				<td>{firmaform_stadt_html}</td>
			</tr>
			<tr>
				<td>{firmaform_telefon_label}</td>
				<td>{firmaform_fax_label}</td>
			</tr>
			<tr>
				<td>{firmaform_telefon_html}</td>
				<td>{firmaform_fax_html}</td>
			</tr>
			<tr>
				<td>{firmaform_email_label}</td>
				<td>{firmaform_internet_label}</td>
			</tr>
			<tr>
				<td>{firmaform_email_html}</td>
				<td>{firmaform_internet_html}</td>
			</tr>
			<tr>
				<td colspan="2">{firmaform_mobil_label}</td>
			</tr>
			<tr>
				<td colspan="2">{firmaform_mobil_html}</td>
			</tr>
			<tr>
				<td>{firmaform_bankname_label}</td>
				<td>{firmaform_bankleitzahl_label}</td>
			</tr>
			<tr>
				<td>{firmaform_bankname_html}</td>
				<td>{firmaform_bankleitzahl_html}</td>
			</tr>
			<tr>
				<td colspan="2">{firmaform_kontonummer_label}</td>
			</tr>
			<tr>
				<td colspan="2">{firmaform_kontonummer_html}</td>
			</tr>
			<tr>
				<td colspan="2">{firmaform_steuernummer_label}</td>
			</tr>
			<tr>
				<td colspan="2">{firmaform_steuernummer_html}</td>
			</tr>
			<tr>
				<td colspan="2">{firmaform_submit_label}</td>
			</tr>
			<tr>
				<td colspan="2">{firmaform_submit_html}</td>
			</tr>
			<tr>
				<td id="error" colspan="2" class="error">
				<!-- BEGIN firmaform_error_loop -->
				{firmaform_error}<br />
				<!-- END firmaform_error_loop -->
				</td>
			</tr>
		</table>
	</form>
</div>
<!-- END STAMMDATEN -->