<!-- BEGIN KUNDENSUCHEBOX -->
<script type="text/javascript">
function kundensuche()
{
	var suchbegriff = $('#suchfeld').val();
	var suchenach = $("input[name='suchart']:checked").val();
	var howmany = $("select[name='anzahltreffer'] :selected").val();
	var appstate = "applicationstate.html";
   	$.ajax({  
   			   	cache: false,
   		   		type: "POST",  
   		   		url: appstate,  
   		   		data: "suchbegriff=" + suchbegriff + "&howmany=" + howmany + "&suchenach=" + suchenach,
   		   		success: function()
   		   		{  	   	  
			   		var ajxFile = 'kundenliste.html';
			   	   	$.ajax(
			   	   		   	{  
			   	   			   	cache: false,
			   	   		   		type: "POST",  
			   	   		   		url: ajxFile,
			   	   		   		success: function(html)
			   	   		   		{  	   	  
			   	   		   			$('div').remove('#formdiv');
			   	   		   			$('br').remove('#break');
			   	   		   			$("#kundenlistebox").replaceWith(html);	   	  
			   	   		   		} 
			   	   			});	   	  
   		   		} 
   			});

}
</script>
<div id="kundensuchebox_visibility">
	<div class="klappbox bold">
		<a href="#"	rel="toggle[box_kundensuche]" data-openimage="./view/images/klappbox_button_zu.jpg" data-closedimage="./view/images/klappbox_button_auf.jpg">
			<img src="klappbox_button_auf.jpg" border="0" />
		</a>
		<div class="klappbox_beschriftung">Kundensuche</div>
	</div>
	<div id="box_kundensuche">
		<form {suchkundeform_attributes}>
			<p>
			{suchkundeform_suchart_html}
			</p>
			<p>{suchkundeform_suchfeld_label}</p>
			<p>{suchkundeform_suchfeld_html}</p>
			<p>{suchkundeform_anzahltreffer_label}</p>
			<p>{suchkundeform_anzahltreffer_html}</p>
		</form>
	</div>
</div>
<!-- END KUNDENSUCHEBOX -->