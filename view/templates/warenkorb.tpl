<!-- BEGIN WARENKORB -->
<script type="text/javascript">
$(document).ready(function (){
	$('#warenkorbloeschen').click(function(){
		deleteWarenkorb();
	});
	
	$('#warenkorbeintragen').click(function(){
		bestellungabsenden();
	});
});
</script>
<table>
<!-- BEGIN BESTELLPOSTEN -->
  <tr>
    <td style="vertical-align: top;">{FORMAT}</td>
    <td style=" vertical-align: top;vertical-align: top;">{BILDANZAHL}x</td>
    <td style="width: 60px; vertical-align: top; text-align: right;">{PREIS} €</td>
  </tr>
<!-- END BESTELLPOSTEN -->
  <tr>
  	<td colspan="2" class="bold">gesamt</td>
  	<td style=" text-align: right;">{GESAMTPREIS} €</td>
  </tr>
</table>
<p>Anmerkungen</p>
<textarea class="form" cols="30" rows="10" id="anmerkungen"></textarea>
<input type="checkbox" id="agbgelesen">Ich habe die AGB gelesen, und bin damit einverstanden.</input>
<input type="submit" value="Bestellung abschicken" id="warenkorbeintragen" class="form mouseoverhand margin_top_10" />
<input type="submit" value="Warenkorb löschen" id="warenkorbloeschen" class="form mouseoverhand margin_top_10" />
<div id="warenkorberror" class="error"></div>
<!-- END WARENKORB -->