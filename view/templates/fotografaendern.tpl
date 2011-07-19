<!-- BEGIN FOTOGRAFAENDERN -->
<script type="text/javascript">
$(document).ready(function() {

    var options = { 
        target:        '#formdiv',
        replaceTarget: 	false,
        success:       showResponse
    }; 
    $('#fotografaendernform').ajaxForm(options);

});

function showResponse(responseText, statusText, xhr, $form)  
{	
	//alert($(responseText).find('#error').text().length);
    if($(responseText).find('#error').text().length == 12){
    	hideFotografAendern();
    	$('#fotografenlistebox').load('index.php?controller=fotografenliste #fotografenlistebox > *')
	}
}
</script>
	<div id="fotografaendernbox" class="border padding_10 autowidth margin_bottom_10">
		<form {fotografaendernform_attributes}>
			<table>
				<tr>
					<td>{fotografaendernform_vorname_label}</td>
					<td>{fotografaendernform_nachname_label}</td>
				</tr>
				<tr>
					<td>{fotografaendernform_vorname_html}</td>
					<td>{fotografaendernform_nachname_html}</td>
				</tr>
				<tr>
					<td>{fotografaendernform_loginname_label}</td>
					<td>{fotografaendernform_passwort_label}</td>
				</tr>
				<tr>
					<td>{fotografaendernform_loginname_html}</td>
					<td>{fotografaendernform_passwort_html}</td>
				</tr>
				<tr>
					<td>{fotografaendernform_submit_html}</td>
					<td><input type="submit" value="Abbrechen" class="form" name="Abbrechen" id="updatefotografendatenabbrechen" /></td>
				</tr>
				<tr>
					<td id="error" colspan="2" class="error">
					<!-- BEGIN fotografaendernform_error_loop -->
					{fotografaendernform_error}<br />
					<!-- END fotografaendernform_error_loop -->
					</td>
				</tr>
			</table>
		</form>
	</div>
<!-- END FOTOGRAFAENDERN -->