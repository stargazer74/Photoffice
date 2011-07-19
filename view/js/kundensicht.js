$(document).ready(function() {
	$(".singleimage").fancybox();	
	$("a.gruppe").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false
	});
	
	animatedcollapse.addDiv('bestellungbox', 'fade=0, hide=1');
	animatedcollapse.addDiv('warenkorbbox', 'fade=0, hide=1');
	animatedcollapse.init();
	
	$('#selectall').click(function(){
		$("#allebilder").checkCheckboxes();
	});
	
	$('#deselectall').click(function(){
		$("#allebilder").unCheckCheckboxes();
	});	
	
	$('#inwarenkorb').click(function(){
		sendFormData();
	});	
	
	$('#anzahlbilder').keyup(function(){
		resetAnzahl();
	});
	
	$('#papiergroesseselectbox').ajaxAddOption("getpapierformat.html");
	
	setPapierformatOptions();

	$('#warenkorbbox').load('warenkorb.html');
	
	$(function() {
	    $(this).bind("contextmenu", function(e) {
	        e.preventDefault();
	    });
	}); 
});

function einzelgalerie(idgalerie)
{
	var ajxFile = "sessionstate.html"; 	   
	$.ajax(
	{  
	   	cache: false,
		type: "POST",  
		url: ajxFile,  
		data: "galerieid=" + idgalerie,
		success: function()
		{
			location.href='kundeeinzelgalerie.html';
		}
	});
}

function setPapierformatOptions()
{
	$("#papiergroesseselectbox").removeOption(/./);
	var id = $("select[name='Papierformat']").val();
	var ajxFile = "sessionstate.html"; 	   
	$.ajax(
	{  
	   	cache: false,
		type: "POST",  
		url: ajxFile,  
		data: "papiertypid=" + id,
		success: function()
		{
		$('#papiergroesseselectbox').ajaxAddOption("getpapierformat.html");
		}
	});
}

function sendFormData()
{
	$("div#errorfeld").text("");
	var bilder_string = ''; 
	$(":input[name='bilder']").each(function() {
        if (this.checked)
        {
            bilder_string += "&bilder[]=" + this.value; 
        } 
    }); 
	var anzahlbilder = $('#anzahlbilder').val();
	var papiertypid = $("select[name='Papierformat']").val();
	var groesse = $("select[name='Groesse']").val();

	if(bilder_string != '')
	{
		$.ajax( { 
			cache: false,
	        type: "POST", 
	        url: "bestellungeintragen.html", 
	        data: "anzahlbilder=" + anzahlbilder + "&papiertypid=" + papiertypid + "&groesse=" + groesse + bilder_string, 
	        success: 
	            function(t) 
	            { 
					$("div#errorfeld").append(t);
					$('#warenkorbbox').load('warenkorb.html', function(t){
					
					$.ajax( { 
						cache: false,
				        type: "POST", 
				        url: "getbildanzahlen.html",
				        dataType: "json",
				        success: function(map) {
							
							$.each(map, function(key, value) { 
							  $('#'+key).text('bestellte Anzahl: '+value); 
							});
				        }, 
				        error: 
				            function() 
				            { 
				                $("div#errorfeld").append("Problem beim Anzeigen der Anzahlen."); 
				            } 
				    }); 
						
				});
	            }, 
	        error: 
	            function() 
	            { 
	                $("div#errorfeld").append("An error occured during processing"); 
	            } 
	    }); 
	}else{
		$("div#errorfeld").append("Sie müssen erst ein oder mehrere Fotos auswählen.");
	}
}

function resetAnzahl()
{
	var Anzahl = $('#anzahlbilder').val();
	var Suche = /^[0-9]+$/;
	var tester = Suche.test(Anzahl);
	if(tester == false)
	{
		$('#anzahlbilder').val('1');
	}
}

function deleteWarenkorb()
{
	var answer = confirm("Möchten Sie die Bestellung wirklich löschen?")
	if (answer){
		$.ajax( { 
			cache: false,
	        type: "POST", 
	        url: "getbildanzahlen.html",
	        dataType: "json",
	        success: function(t) {
				var map = t; 
				$.each(map, function(key, value) { 
				  $('#'+key).text('bestellte Anzahl: 0'); 
				});
	        }, 
	        error: 
	            function() 
	            { 
	                $("div#errorfeld").append("An error occured during processing"); 
	            } 
	    }); 
		
		
		
		var ajxFile = "kundedelete.html"; 	   
	   	$.ajax(
	   	{  
		   	cache: false,
	   		type: "POST",  
	   		url: ajxFile,  
	   		data: "was=warenkorb",  
	   		success: function(phpData)
	   		{
	   			$("#warenkorbbox").html(phpData);	   	  
	   		}
		});
	}
}

function bestellungabsenden()
{
	$('#warenkorberror').text('');
	var anmerkung = $('#anmerkungen').val();
	if($("#agbgelesen").attr("checked"))
	{
	   	$.ajax(
	   	{  
		   	cache: false,
	   		type: "POST",  
	   		url: "warenkorbeintragen.html",  
	   		data: "anmerkung=" + anmerkung + "&kundeabschliessen=1",  
	   		success: function(phpData)
	   		{
	   			$("#warenkorbbox").text('Vielen Dank für Ihre Bestellung.');	   	  
	   		},
	   		error: function(e)
	   		{
	   			$('#warenkorberror').append(e);
	   		}
		});
	}else{
		$('#warenkorberror').text('Sie müssen erst die AGB akzeptieren.');
	}
}