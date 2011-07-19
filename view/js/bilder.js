$(document).ready(function()
{	
	$("ul.css-tabs").tabs("div.css-panes > div", {effect: 'ajax', history: true});
	animatedcollapse.addDiv('box_galerieeinstellungen', 'fade=0, hide=1');
	animatedcollapse.addDiv('box_uploadbild', 'fade=0, hide=1');
	animatedcollapse.addDiv('box_EXIF', 'fade=0, hide=1');
	animatedcollapse.addDiv('box_oeffentlichegalerie', 'fade=0, hide=1');
	animatedcollapse.init();
	
	$('#box_galerieeinstellungen').load('galerieaendern.html');
	$('#einzelgalerie').load('bilduebersicht.html');
	
	if (!$('#box_oeffentlichegalerie').is (':hidden'))
	{
		setKlappBoxVisible('oeffentlichegalerienbox_visibility');
	}
	
	$('#box_oeffentlichegalerie').load('neueoeffentlichegalerie.html');
});

function einzelgalerie(idgalerie)
{
	var ajxFile = "applicationstate.html"; 	   
	$.ajax(
	{  
	   	cache: false,
		type: "POST",  
		url: ajxFile,  
		data: "galerieid=" + idgalerie,
		success: function()
		{
			location.href='einzelgalerie.html';
		}
	});
}

function changePictureStatus()
{
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
}

function showPictureDetails(pictureid)
{
	$('#box_EXIF').removeClass('fragezeichen');
	var ajxFile = "bilddetails.html"; 	   
	$.ajax(
	{  
	   	cache: false,
		type: "POST",  
		url: ajxFile,  
		data: "pictureid=" + pictureid,  
		success: function(phpData)
		{  	   	  
			$("#box_EXIF").html(phpData);	   	  
		} 
	});
}

function delete_picture(was, id)
{
	var answer = confirm("Möchten Sie das Bild wirklich löschen?")
	if (answer){
		var ajxFile = "ajaxdelete.html"; 	   
	   	$.ajax(
	   	{  
		   	cache: false,
	   		type: "POST",  
	   		url: ajxFile,  
	   		data: "was=" + was + "&id=" + id,  
	   		success: function(phpData)
	   		{
	   			$("#einzelgalerie").html(phpData);	   	  
	   		} 
		});
	}
}

function delete_galerie(was, id)
{
	var answer = confirm("Möchten Sie die Galerie wirklich löschen?")
	if (answer){
		var ajxFile = "ajaxdelete.html"; 	   
	   	$.ajax(
	   	{  
		   	cache: false,
	   		type: "POST",  
	   		url: ajxFile,  
	   		data: "was=" + was + "&id=" + id,  
	   		success: function(phpData)
	   		{
	   			$("#galerieuebersicht").html(phpData);	   	  
	   		} 
		});
	}
}

function deleteOeffentlicheGalerie(was, id)
{
	var answer = confirm("Möchten Sie die Galerie wirklich löschen?")
	if (answer){
		var ajxFile = "ajaxdelete.html"; 	   
	   	$.ajax(
	   	{  
		   	cache: false,
	   		type: "POST",  
	   		url: ajxFile,  
	   		data: "was=" + was + "&id=" + id,  
	   		success: function(phpData)
	   		{
	   			$("#galerieuebersicht").load('oeffentlichegalerien.html');	   	  
	   		} 
		});
	}
}

function setKlappBoxInvisible(id)
{
	$('#'+id).css('visibility', 'hidden');
};

function setKlappBoxVisible(id)
{
	$('#'+id).css('visibility', 'visible');
};