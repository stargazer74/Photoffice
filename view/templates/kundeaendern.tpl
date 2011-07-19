<!-- BEGIN KUNDEAENDERN -->
<script type="text/javascript">
$(document).ready(function() {

    var options = { 
        target:        '#formdiv',
        replaceTarget: 	false,
        success:       showResponse
    }; 
    $('#kundeaendernform').ajaxForm(options);

});

function showResponse(responseText, statusText, xhr, $form)  
{	
	//alert($(responseText).find('#error').text().length);
    if($(responseText).find('#error').text().length == 12){
    	hideKundeAendern();
    	$('#kundenlistebox').load('index.php?controller=kundenliste #kundenlistebox > *')
	}
}
</script>
	<div id="kundeaendernbox" class="border padding_10 autowidth margin_bottom_10">
		<form {kundeaendernform_attributes}>
			<table>
				<tr>
					<td>{kundeaendernform_kundennummer_label}</td>
					<td></td>
				</tr>
				<tr>
					<td>{kundeaendernform_kundennummer_html}</td>
					<td></td>
				</tr>
				<tr>
					<td>{kundeaendernform_firma_label}</td>
					<td></td>
				</tr>
				<tr>
					<td>{kundeaendernform_firma_html}</td>
					<td></td>
				</tr>
				<tr>
					<td>{kundeaendernform_vorname_label}</td>
					<td>{kundeaendernform_name_label}</td>
				</tr>
				<tr>
					<td>{kundeaendernform_vorname_html}</td>
					<td>{kundeaendernform_name_html}</td>
				</tr>
				<tr>
					<td>{kundeaendernform_strasse_label}</td>
					<td>{kundeaendernform_hausnummer_label}</td>
				</tr>
				<tr>
					<td>{kundeaendernform_strasse_html}</td>
					<td>{kundeaendernform_hausnummer_html}</td>
				</tr>
				<tr>
					<td>{kundeaendernform_plz_label}</td>
					<td>{kundeaendernform_stadt_label}</td>
				</tr>
				<tr>
					<td>{kundeaendernform_plz_html}</td>
					<td>{kundeaendernform_stadt_html}{kundeaendernform_hidden}</td>
				</tr>
				<tr>
					<td>{kundeaendernform_telefon_label}</td>
					<td>{kundeaendernform_mail_label}</td>
				</tr>
				<tr>
					<td>{kundeaendernform_telefon_html}</td>
					<td>{kundeaendernform_mail_html}</td>
				</tr>
				<tr>
					<td>{kundeaendernform_submit_html}</td>
					<td><input type="submit" value="Abbrechen" class="form" name="Abbrechen" id="updatekundendatenabbrechen" /></td>
				</tr>
				<tr>
					<td id="error" colspan="2" class="error">
					<!-- BEGIN kundeaendernform_error_loop -->
					{kundeaendernform_error}<br />
					<!-- END kundeaendernform_error_loop -->
					</td>
				</tr>
			</table>
		</form>
	</div>
<!-- END KUNDEAENDERN -->