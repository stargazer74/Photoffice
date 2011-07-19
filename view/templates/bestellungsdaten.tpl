<!-- BEGIN BESTELLUNGSDATEN -->
<script type="text/javascript">
$(document).ready(function() {
	$('#exit').click(function(){
		hideBestellDaten();
	});

	$('#pdf').click(function(){
		generatepdf();
	});
});
</script>
	<div id="bestellungsdatenbox" class="border padding_10 autowidth margin_10">
	<p>Der Kunde hat die Bestellung am {DATUM} um {UHRZEIT} Uhr abgegeben.</p>
	<table class="width_100">
		<tr>
			<th>Bildformat</th>
			<th>Anzahl</th>
			<th>Bild</th>
			<th>Preis</th>
		</tr>
		<!-- BEGIN BILDLISTE -->
		<tr class="{LISTBACKGROUND}">
			<td>{FORMAT}</td>
			<td>{BILDANZAHL}</td>
			<td>{BILDNAME}</td>
			<td>{PREIS} €</td>
		</tr>
		<!-- END BILDLISTE -->
	</table>	
	<input type="submit" value="Box schließen" id="exit" class="form mouseoverhand">
	<input type="submit" value="als PDF ausgeben" id="pdf" class="form mouseoverhand">
	</div>
<!-- END BESTELLUNGSDATEN -->