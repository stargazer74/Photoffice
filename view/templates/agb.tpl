<!-- BEGIN AGB -->
<script type="text/javascript">
tinyMCE.init(
{
	// General options
	mode : 				"specific_textareas",
	editor_selector : 	"mceEditor",
	theme : 			"advanced",
	skin : 				"o2k7",
	skin_variant : 		"black",
	plugins : 			"safari,iespell, paste",
	language : 			"de",
	height: 			"350",


	// Theme options
	theme_advanced_blockformats : "p,h2,h3,h4",
	theme_advanced_buttons1 : "bold,italic,underline,|,justifyleft,justifycenter,justifyright,justifyfull,formatselect,bullist,numlist,|,outdent,indent,|,undo,redo,|,pastetext,selectall",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : false,

	// content CSS
	content_css : "./view/css/style.css",

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "lists/template_list.js",
	external_link_list_url : "lists/link_list.js",
	external_image_list_url : "lists/image_list.js",
	media_external_list_url : "lists/media_list.js"
}
);


$(document).ready(function() {
    var options = { 
        target:        '#formdiv',
        replaceTarget: 	true,
        success:       showResponse
    }; 
    $('#agbform').ajaxForm(options);
}); 
 
function showResponse(responseText, statusText, xhr, $form)  
{ 
	for (i = 1; i <= 1; i++)
	{
		$('#break').remove();
	}
	alert('Daten wurden geändert.');
} 
</script>
<br id="break" />
<div id="formdiv" class="border padding_10">
<p>Hier können Sie ihre AGBs ändern.</p>
<form {agbform_attributes}>
{agbform_agb_html}
<br />
{agbform_submit_html}
{agbform_hidden}
</form>
</div>
<!-- END AGB -->