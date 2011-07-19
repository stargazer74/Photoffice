<!-- BEGIN KUNDEEINZELGALERIE -->
	<form id="allebilder">
	<!-- BEGIN BILD -->
		<div class="margin_left_10 margin_top_10 x_small bold float_left aeussere_bildbox_kunde">			
			<div class="border passepartout_bildicon">
				<div class="innere_bildbox">
					<a rel="gruppe" class="singleimage" href="./view/images/galeriebilder/{GALERIEID}/{BILDNAME}"><img src="./view/images/galeriebilder/{GALERIEID}/{EINZELBILD}" /></a>
				</div>
			</div>
			<div style="width: auto; margin-top: 5px; height: auto; text-align: center;">{BILDNAME}</div>
			<div class="autowidth" style="text-align: left; height: auto; padding-left: 10px; padding-top: 5px;">
				<input type="checkbox" name="bilder" value="{PICTUREID}"/>Auswahl
			</div>
			<div id="{PICTUREID}" style="width: auto; margin-top: 5px; height: auto; text-align: left; padding-left: 13px;">bestellte Anzahl: {BESTELLANZAHL}</div>
		</div>
	<!-- END BILD -->
	</form>
<!-- END KUNDEEINZELGALERIE -->

<!-- BEGIN KEINBILD -->
<h2 class="margin_top_10 margin_left_10">Es gibt noch keine Bilder in dieser Galerie.</h2>
<!-- END KEINBILD -->