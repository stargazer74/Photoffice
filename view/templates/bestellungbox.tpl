<!-- BEGIN BESTELLUNGBOX -->

	<div class="klappbox bold">
		<a href="#"	rel="toggle[bestellungbox]" data-openimage="./view/images/klappbox_button_zu.jpg" data-closedimage="./view/images/klappbox_button_auf.jpg">
			<img src="klappbox_button_auf.jpg" border="0" />
		</a>
		<div class="klappbox_beschriftung">Bestellung</div>
	</div>
	<div id="bestellungbox" class="">	
		<input type="submit" id="deselectall" class="form mouseoverhand" value="Auswahl aufheben" />
		<input type="submit" id="selectall" class="form mouseoverhand" value="alle auswählen" />
		<p>
			<p>Wählen Sie einen Liefertyp aus.</p>
			<select name="Papierformat" class="form" onchange="javascript:setPapierformatOptions()">
			<!-- BEGIN PAPIERFORMATAUSWAHL -->
			<option value="{PAPIERFORMATID}">{PAPIERFORMAT}</option>
	      	<!-- END PAPIERFORMATAUSWAHL -->
			</select>
		</p>
		<p>
			<p>Wählen Sie ein Bildformat aus.</p>
			<select name="Groesse" id="papiergroesseselectbox" class="form">
			</select>
		</p>
		<p>
			<p>Anzahl der Bilder</p>
			<input type="text" class="form" id="anzahlbilder" size="3" value="1" />
		</p>
		<p>
			<input type="submit" id="inwarenkorb" value="Auswahl zum Warenkorb hinzufügen" class="form mouseoverhand" />
		</p>
		<div class="error" id="errorfeld"></div>
	</div>

<!-- END BESTELLUNGBOX -->