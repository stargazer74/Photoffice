<!-- BEGIN NEUGALERIE -->
<script type="text/javascript">
$(document).ready(function() { 
    var options = { 
        target:        '#neuegalerieformdiv',
        replaceTarget: 	true,
        success:       showResponse
    }; 
    $('#neuegalerieform').ajaxForm(options);
}); 
 
function showResponse(responseText, statusText, xhr, $form)  
{ 
};
</script>
<div id ="neuegalerieformdiv">
	<h3>Neue Kundengalerie anlegen</h3>
	<p>Legen Sie hier eine neue Galerie für den aktuellen Kunden an.</p>
	<form {neuegalerieform_attributes}>
		<table>
			<tr>
				<td>{neuegalerieform_galeriename_label}</td>
			</tr>
			<tr>
				<td>{neuegalerieform_galeriename_html}{neuegalerieform_hidden}</td>
			</tr>
			<tr>
				<td>{neuegalerieform_submit_label}</td>
			</tr>
			<tr>
				<td>{neuegalerieform_submit_html}</td>
			</tr>
			<tr>
				<td id="error" class="error">
				<!-- BEGIN neuegalerieform_error_loop -->
				{neuegalerieform_error}<br />
				<!-- END neuegalerieform_error_loop -->
				</td>
			</tr>
		</table>
	</form>
	<h3>Galerien des Kunden</h3>
	<ul class="listeohnedeco">
		<!-- BEGIN GALERIELISTE -->
		<li>{GALERIENAME}</li>
		<!-- END GALERIELISTE -->
		
		<!-- BEGIN KEININHALT -->
		Dieser Kunde hat noch keine Galerie.
		<!-- END KEININHALT -->
		
	</ul>
</div>
<!-- END NEUGALERIE -->