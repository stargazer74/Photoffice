<!-- BEGIN KUNDENLISTE -->
<br id="break" />
<div id ="formdiv" style="display: none;">
</div>
<div id="kundenlistebox" class="border padding_10">
	<ul class="aufzaehlungsliste">
	<!-- BEGIN LISTEKUNDEN -->
	
		<li class="autowidth {LISTBACKGROUND}">
			<div class="kundenliste float_left" style="width: 80px;">{KUNDENNUMMER}</div>
			<div class="kundenliste float_left" style="width: 150px;"><a href="javascript:void()" onClick="showKundenDaten({KUNDENID})">{NAME}</a></div>
			<div class="kundenliste float_left" style="width: 150px;">{STRASSE}</div>
			<div class="kundenliste float_left" style="width: 150px;">{STADT}</div>
			<a class="update_button float_left" href="javascript:void()" onClick="javascript:showKundeAendern({KUNDENID}, {PAGEID})" title="Kundendaten ändern" ></a>
			<a class="delete_button" href="javascript:void()" onclick="javascript:delete_item('{WAS}', '{IDKUNDE}', '{PAGEID}')" title="löscht den Kunden"></a>

		</li>
	
	<!-- END LISTEKUNDEN -->
	</ul>
	<div id="pagerlinks">
	{objekt_linker}
	</div>
</div>
<!-- END KUNDENLISTE -->
