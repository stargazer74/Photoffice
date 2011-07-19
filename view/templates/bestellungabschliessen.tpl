<!-- BEGIN BESTELLUNGABSCHLIESSEN -->
<script type="text/javascript">
$(document).ready(function() {
    var options = { 
        target:        '#formdiv',
        replaceTarget: 	false,
        success:       showResponseBestellung
    }; 
    $('#bestellungabschliessenform').ajaxForm(options);

    $('#bestellungabschliesenabbrechen').click(function (){
        hideBestellDaten();
    });
});
function showResponseBestellung(responseText, statusText, xhr, $form)  
{	
	//alert($(responseText).find('#error').text().length);
    if($(responseText).find('#error').text().length == 12){
    	hideBestellDaten();
    	$('#bestellungslistebox').load('index.php?controller=bestellungslisteinhalt #bestellungslistebox > *')
	}
}
</script>
	<div id="bestellungabschliessenbox" class="border padding_10 autowidth margin_10">
		<form {bestellungabschliessenform_attributes}>
			<table>
				<tr>
					<td>{bestellungabschliessenform_betreff_label}</td>
					<td></td>
				</tr>
				<tr>
					<td>{bestellungabschliessenform_betreff_html}</td>
					<td></td>
				</tr>
				<tr>
					<td>{bestellungabschliessenform_nachricht_label}</td>
					<td></td>
				</tr>
				<tr>
					<td>{bestellungabschliessenform_nachricht_html}</td>
					<td></td>
				</tr>
				<tr>
					<td>{bestellungabschliessenform_submit_html}</td>
					<td><input type="submit" value="Abbrechen" class="form mouseoverhand" name="Abbrechen" id="bestellungabschliesenabbrechen" /></td>
				</tr>
				<tr>
					<td id="error" colspan="2" class="error">
					<!-- BEGIN bestellungabschliessenform_error_loop -->
					{bestellungabschliessenform_error}<br />
					<!-- END bestellungabschliessenform_error_loop -->
					</td>
				</tr>
			</table>
		</form>
	</div>
<!-- END BESTELLUNGABSCHLIESSEN -->