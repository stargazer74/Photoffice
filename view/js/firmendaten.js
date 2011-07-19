function delete_item(was, id) 
{
	var answer = confirm("Möchten Sie das Obkjekt wirklich löschen?")
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
	   			$("#formdiv").replaceWith(phpData);	   	  
	   		} 
		});
	}
};
function showResponse(responseText, statusText, xhr, $form)  
{ 
    //$('#error').text('Daten erfolgreich geändert.');
} 

function showFotografenAendern(idfotograf)
{
	var ajxFile = "applicationstate.html"; 	   
	$.ajax(
	{  
	   	cache: false,
		type: "POST",  
		url: ajxFile,  
		data: "idfotograf=" + idfotograf,
		success: function()
		{
			var ajaxFile = "fotografaendern.html"; 	   
			$.ajax(
			{  
			   	cache: false,
				type: "POST",  
				url: ajaxFile,
				success: function(phpData)
				{  	   	  
					$("#formdiv").html(phpData);
					$('#formdiv').slideDown('slow');
				} 
			});			
		} 
	});
	
};

function hideFotografAendern()
{
	$('#formdiv').hide('slow', function(){
		$('div').remove('#fotografaendernbox');
	});	
}

function delete_fotograf(was, id) 
{
	var answer = confirm("Möchten Sie den Fotograf wirklich löschen?")
	if (answer){
		var ajxFile = "ajaxdelete.html"; 	   
	   	$.ajax(
	   	{  
		   	cache: false,
	   		type: "POST",  
	   		url: ajxFile,  
	   		data: "was=" + was + "&id=" + id,  
	   		success: function(html)
	   		{
		   		$('div').remove('#formdiv');
	   		   	$('br').remove('#break');
	   			$("#fotografenlistebox").replaceWith(html);	   	  
	   		} 
		});
	}
};