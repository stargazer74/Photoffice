<!-- BEGIN BESTELLUNGSLISTEINHALT -->
<br id="break" />
<div id ="formdiv" style="display: none;">
</div>

<div id="bestellungslistebox" class="border padding_10 margin_10">
	<ul class="aufzaehlungsliste">
	<!-- BEGIN LISTE -->
	
		<li class="autowidth {LISTBACKGROUND}">
			<div class="kundenliste float_left" style="width: 80px;">{KUNDENNUMMER}</div>
			<div class="kundenliste float_left" style="width: 150px;">{NAME}</div>
			<div class="kundenliste float_left" style="width: 150px;">{PREIS}</div>
			<a class="update_button float_left" href="javascript:void()" onClick="javascript:showBestellDaten({BESTELLID})" title="Bestellung einsehen" ></a>
			<a class="{MAILBUTTONCSS} float_left" href="javascript:void()" onClick="javascript:{FUNKTION}" title="Kunde eine Mail schreiben und Bestellung abschließen" ></a>
			<a class="delete_button" href="javascript:void()" onclick="javascript:delete_item('{WAS}', '{BESTELLID}')" title="Bestellung löschen"></a>
		</li>
	
	<!-- END LISTE -->
	</ul>
</div>
<!-- END BESTELLUNGSLISTEINHALT -->