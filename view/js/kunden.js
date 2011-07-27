$(document).ready(function(){
	$("ul.css-tabs").tabs("div.css-panes > div", {effect: 'ajax'});
	animatedcollapse.addDiv('box_kundensuche', 'fade=0, hide=1');
	animatedcollapse.addDiv('box_kundendaten', 'fade=0, hide=1');
	animatedcollapse.addDiv('box_kundengalerien', 'fade=0, hide=1');
	animatedcollapse.init();
});


function showKundeAendern(idkunde)
{
	var ajxFile = "applicationstate.html"; 	   
	$.ajax(
	{  
	   	cache: false,
		type: "POST",  
		url: ajxFile,  
		data: "idkunde=" + idkunde,
		success: function()
		{
			var ajaxFile = "kundeaendern.html"; 	   
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

function hideKundeAendern()
{
	$('#formdiv').hide('slow', function(){
		$('div').remove('#kundeaendernbox');
	});	
}

function setKlappBoxInvisible(id)
{
	$('#'+id).css('visibility', 'hidden');
};

function setKlappBoxVisible(id)
{
	$('#'+id).css('visibility', 'visible');
};

function showPage(pageid)
{
	var ajxFile = "applicationstate.html"; 	   
	$.ajax(
	{  
	   	cache: false,
		type: "POST",  
		url: ajxFile,  
		data: "pageID=" + pageid 
	});
	$('#kundeninhalt').load('index.php?controller=kundenliste&pageID='+pageid);
};

function showKundenDaten(kundenid)
{
	$('#box_kundendaten').removeClass('fragezeichen');
	$('#box_kundengalerien').removeClass('fragezeichen');
	var ajxFile = "kundendaten.html"; 	   
	$.ajax(
	{  
	   	cache: false,
		type: "POST",  
		url: ajxFile,  
		data: "kundenid=" + kundenid,  
		success: function(phpData)
		{  	   	  
			$("#box_kundendaten").html(phpData);	   	  
		} 
	});
	$('#box_kundengalerien').load('index.php?controller=neuegalerie&kundenid='+kundenid);
	$('#box_kundengalerien').css({'height': 'auto'});
}

function delete_item(was, id, pageid) 
{
	var answer = confirm("Möchten Sie das Obkjekt wirklich löschen?");
	if (answer){
		var ajxFile = "ajaxdelete.html"; 	   
	   	$.ajax(
	   	{  
		   	cache: false,
	   		type: "POST",  
	   		url: ajxFile,  
	   		data: "was=" + was + "&id=" + id + "&pageID=" + pageid,  
	   		success: function(html)
	   		{  	   	  
		   		$('div').remove('#formdiv');
	   		   	$('br').remove('#break');
	   			$("#kundenlistebox").replaceWith(html);	   	  
	   		} 
		});
	}
};