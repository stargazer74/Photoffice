function showBestellDaten(idbestellung)
{
	var ajxFile = "applicationstate.html"; 	   
	$.ajax(
	{  
	   	cache: false,
		type: "POST",  
		url: ajxFile,  
		data: "idbestellung=" + idbestellung,
		success: function()
		{
			var ajaxFile = "bestellungsdaten.html";	   
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

function hideBestellDaten()
{
	$('#formdiv').hide('slow', function(){
		$('div').remove('#bestellungsdatenbox');
	});	
}

function delete_item(was, id) 
{
	var answer = confirm("Möchten Sie die Bestellung wirklich löschen?");
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
	   			$("#bestellungslistebox").replaceWith(html);	   	  
	   		} 
		});
	}
};

function mail(idbestellung)
{
	var ajxFile = "applicationstate.html"; 	   
	$.ajax(
	{  
	   	cache: false,
		type: "POST",  
		url: ajxFile,  
		data: "idbestellung=" + idbestellung,
		success: function()
		{
			var ajaxFile = "bestellungabschliessen.html";	   
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
}

function generatepdf()
{
	window.open("generierebestellungspdf.html");
}