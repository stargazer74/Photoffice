<!-- BEGIN BILDUPLOADBOX -->
<script type="text/javascript">
// <![CDATA[
$(document).ready(function() {
	$('#fileInput').uploadify({
	'uploader'  	: './view/images/uploadify.swf',
	'script'    	: 'index.php',
	'scriptData'	: {'controller': 'dateiupload'},
	'cancelImg' 	: './view/images/cancel.png',
	'auto'      	: false,
	'folder'    	: '/view/images/galeriebilder',
	'multi'			: true,
	'fileDesc'		: '*.jpg',
	'fileExt'		: '*.jpg;*.JPG',
	'sizeLimit'		: '524288',
	'buttonImg'		: './view/images/browse.jpg',
	'width'			: '105',
	'height'		: '23',
	'onComplete'	: function(){
		$('#einzelgalerie').load('bilduebersicht.html');
	},
	});

	var idfotograf = $("#fotografenauswahl :selected").val();
	var wasserzeichen = $('#dateiuploadform input:radio:checked').val();
	var watermarktrans = $("#transparenz :selected").val();	
	var ajxFile = "applicationstate.html";	   
	$.ajax(
	{  
	   	cache: false,
		type: "POST",  
		url: ajxFile,  
		data: "idfotograf=" + idfotograf + "&wasserzeichen=" + wasserzeichen + "&watermarktrans=" + watermarktrans
	});
});
// ]]>
</script>
	<div class="klappbox bold">
		<a href="#"	rel="toggle[box_uploadbild]" data-openimage="./view/images/klappbox_button_zu.jpg" data-closedimage="./view/images/klappbox_button_auf.jpg">
			<img src="klappbox_button_auf.jpg" border="0" />
		</a>
		<div class="klappbox_beschriftung">Bildupload</div>
	</div>
	<div id="box_uploadbild">
		<form {dateiuploadform_attributes}>
			<p>{dateiuploadform_fotografenauswahl_label}</p>
			<p>{dateiuploadform_fotografenauswahl_html}</p>
			<p>Soll den Bildern ein Wasserzeichen hinzugefügt werden?</p>
			<p>{dateiuploadform_wasserzeichen_html}</p>		
			<p>{dateiuploadform_transparenz_label}</p>
			<p>{dateiuploadform_transparenz_html}</p>		
		</form>
		<p>
			max. Dateigröße 512kB
		</p>
		<p>
			<input id="fileInput" name="fileInput" type="file" />
		</p>
		<a href="javascript:$('#fileInput').uploadifyUpload();" class="form">Dateien hochladen</a> <a href="javascript:$('#fileInput').uploadifyClearQueue();" class="form">Liste löschen</a>
	</div>

<!-- END BILDUPLOADBOX -->