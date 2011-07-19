<!-- BEGIN FOTOGRAFENLISTE -->
<br id="break" />
<div id ="formdiv" style="display: none;">
</div>

<div id="fotografenlistebox" class="border padding_10">
	<ul class="aufzaehlungsliste">
	<!-- BEGIN LISTEFOTOGRAFEN -->
	
		<li class="autowidth {LISTBACKGROUND}">
			<div class="kundenliste float_left" style="width: 150px;">{NAME}</div>
			<div class="kundenliste float_left" style="width: 150px;">{LOGINNAME}</div>
			<a class="update_button float_left" href="javascript:void()" onClick="javascript:showFotografenAendern({FOTOGRAFENID})" title="Fotografendaten ändern" ></a>
			<a class="delete_button" href="javascript:void()" onclick="javascript:delete_fotograf('fotograf', '{FOTOGRAFENID}')" title="löscht den Fotorafen"></a>

		</li>
	
	<!-- END LISTEFOTOGRAFEN -->
	</ul>
	<div class="error"></div>
</div>
<!-- END FOTOGRAFENLISTE -->