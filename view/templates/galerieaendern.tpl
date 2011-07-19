<!-- BEGIN GALERIEAENDERN -->
<script type="text/javascript">
$(document).ready(function(){
	var options = {
	        target:        '#box_galerieeinstellungen',
	        replaceTarget: 	false,
	        success:       showResponse
	    };
	$('#galerieeinstellungenform').ajaxForm(options);

	function showResponse(responseText, statusText, xhr, $form)
	{
		alert('Daten wurden geändert.');
	};
});
</script>
<form{galerieeinstellungenform_attributes}>
	<p>{galerieeinstellungenform_onlinestatus_html}</p>
	<p>{galerieeinstellungenform_galeriename_label}</p>
	<p>{galerieeinstellungenform_galeriename_html}</p>
	<p>{galerieeinstellungenform_verfallsdatum_label}</p>
	<p>{galerieeinstellungenform_verfallsdatum_html}</p>
	<p>{galerieeinstellungenform_kundenmail_label}</p>
	<p>{galerieeinstellungenform_kundenmail_html}</p>
	<p>{galerieeinstellungenform_submit_html}</p>
	<p class="error">
	<!-- BEGIN galerieeinstellungenform_error_loop -->
	{galerieeinstellungenform_error}<br />
	<!-- END galerieeinstellungenform_error_loop --></p>
</form>
<!-- END GALERIEAENDERN -->
