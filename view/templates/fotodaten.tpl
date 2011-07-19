<!-- BEGIN FOTODATEN -->
<script type="text/javascript">
$(document).ready(function() {
    var options = {
        target:        '#formdiv',
        replaceTarget: 	true
    };
    $('#insertpreisform').ajaxForm(options);
    $('#insertbildformatform').ajaxForm(options);
    $('#insertpapierformatform').ajaxForm(options);
    $('#portoform').ajaxForm(options);

    $('input:checkbox').click(function()
   	{

    	var ajxFile = "ajaxupdate.html";
    	$.ajax(
    	{
    	   	cache: false,
    		type: "POST",
    		url: ajxFile,
    		data: "was=zahlungsart&id=" + $(this).attr('id') + "&aktiv=" + $(this).val(),
    		success: function(daten)
    		{
    			$('#erfolgsmeldung_zahlungsarten').html(daten);
    		}
    	});
       	//alert($(this).val());
	});

});
</script>

<div id="formdiv"><br />
	<div class="border padding_10 autowidth margin_bottom_10">
	<h2>Preisfestlegung</h2>
	<form{insertpreisform_attributes}>
	<table>
		<tr>
			<td>{insertpreisform_bildformatpreis_label}</td>
			<td>{insertpreisform_papierformat_label}</td>
			<td>{insertpreisform_preis_label}</td>
			<td>{insertpreisform_hidden}</td>
		</tr>
		<tr>
			<td>{insertpreisform_bildformatpreis_html}</td>
			<td>{insertpreisform_papierformat_html}</td>
			<td>{insertpreisform_preis_html} in €</td>
			<td>{insertpreisform_submitpreis_html}</td>
		</tr>
		<tr>
			<td colspan="4" class="error">
			<!-- BEGIN insertpreisform_error_loop -->
			{insertpreisform_error}<br />
			<!-- END insertpreisform_error_loop --></td>
		</tr>
	</table>
	</form>
	<ul class="aufzaehlungsliste">
		<!-- BEGIN LISTEPREISE -->

		<li class="autowidth {LISTBACKGROUND}">
		<div style="margin-left: 10px; margin: 2px; width: 200px; float: left;">{PREISLISTEBILDFORMAT}</div>
		<div style="margin-left: 10px; margin: 2px; width: 200px; float: left;">{PREISLISTEPAPIERFORMAT}</div>
		<div style="margin-left: 10px; margin: 2px; width: 80px; float: left;">{PREIS}
		€</div>
		<a class="delete_button" href="javascript:void()"
			onclick="javascript:delete_item('{WAS}', new Array('{IDPAPIER}', '{IDBILD}'))"
			title="löscht den Preis"></a></li>

		<!-- END LISTEPREISE -->
	</ul>
	</div>

	<div class="border padding_10 autowidth margin_bottom_10">
	<h2>Bildformate</h2>
	<form{insertbildformatform_attributes}>
	<table>
		<tr>
			<td>{insertbildformatform_bildformat_label}</td>
			<td>{insertbildformatform_hidden}</td>
		</tr>
		<tr>
			<td>{insertbildformatform_bildformat_html}</td>
			<td>{insertbildformatform_submitbild_html}</td>
		</tr>
		<tr>
			<td colspan="2" class="error">
			<!-- BEGIN insertbildformatform_error_loop -->
			{insertbildformatform_error}<br />
			<!-- END insertbildformatform_error_loop --></td>
		</tr>
	</table>
	</form>
	<ul class="aufzaehlungsliste">
		<!-- BEGIN LISTEBILDFORMATE -->
		<li class="autowidth {LISTBACKGROUND}">
		<div style="margin-left: 10px; margin: 2px; width: auto; float: left;">{BILDFORMAT}</div>
		<a class="delete_button" href="javascript:void()" onclick="javascript:delete_item('{WAS}', '{ID}')" title="löscht das Bildformat"></a></li>
		<!-- END LISTEBILDFORMATE -->
	</ul>
	</div>
	<div id"test" class="border padding_10 autowidth margin_bottom_10">
	<h2>Qualität</h2>
	<form{insertpapierformatform_attributes}>
	<table>
		<tr>
			<td>{insertpapierformatform_papierformat_label}</td>
			<td>{insertpapierformatform_hidden}</td>
		</tr>
		<tr>
			<td>{insertpapierformatform_papierformat_html}</td>
			<td>{insertpapierformatform_submitpapier_html}</td>
		</tr>
		<tr>
			<td colspan="2" class="error">
			<!-- BEGIN insertpapierformatform_error_loop -->
			{insertpapierformatform_error}<br />
			<!-- END insertpapierformatform_error_loop --></td>
		</tr>
	</table>
	</form>
	<ul class="aufzaehlungsliste">
		<!-- BEGIN LISTEPAPIERFORMATE -->
		<li class="autowidth {LISTBACKGROUND}">
		<div style="margin-left: 10px; margin: 2px; width: auto; float: left;">{PAPIERFORMAT}</div>

		<a class="delete_button" href="javascript:void()" onclick="javascript:delete_item('{WAS}', {ID})" title="löscht das Papierformat"></a></li>
		<!-- END LISTEPAPIERFORMATE -->
	</ul>
	</div>

	<div class="border padding_10 autowidth margin_bottom_10">
	<h2>Versandkosten</h2>
	<form{portoform_attributes}>
	<table>
		<tr>
			<td>{portoform_porto_label}</td>
			<td>{portoform_versandpreis_label}</td>
			<td>{portoform_hidden}</td>
		</tr>
		<tr>
			<td>{portoform_porto_html}</td>
			<td>{portoform_versandpreis_html} in €</td>
			<td>{portoform_submitporto_html}</td>
		</tr>
		<tr>
			<td colspan="3" class="error">
			<!-- BEGIN portoform_error_loop -->
			{portoform_error}<br />
			<!-- END portoform_error_loop --></td>
		</tr>
	</table>
	</form>
	<ul class="aufzaehlungsliste">
		<!-- BEGIN LISTEPORTO -->

		<li class="autowidth {LISTBACKGROUND}">
		<div style="margin-left: 10px; margin: 2px; width: 200px; float: left;">{VERSANDART}</div>
		<div style="margin-left: 10px; margin: 2px; width: 80px; float: left;">{VERSANDKOSTEN} €</div>
		<a class="delete_button" href="javascript:void()" onclick="javascript:delete_item('{WAS}', '{ID}')" title="löscht das Porto"></a></li>

		<!-- END LISTEPORTO -->
	</ul>
	</div>

	<div class="border padding_10 autowidth margin_bottom_10">
	<h2>Zahlungsarten</h2>
	<p>Wählen Sie hier bitte die Zahlungsmöglichkeiten aus, die Sie Ihren Kunden bereitstellen möchten.</p>
	<table>
		<tr>
		<!-- BEGIN ZAHLUNGSARTEN -->
		<td><input type="checkbox" id="{IDZAHLUNGSARTEN}" value="{VALUEZAHLUNGSARTEN}" {ISCHECKED} />{ZAHLUNGSART}</td>
		<!-- END ZAHLUNGSARTEN -->
		</tr>
		<tr>
		<td colspan="4"><div style="color: #01ff01;" id="erfolgsmeldung_zahlungsarten"></div></td>
		</tr>
	</table>
	</div>
</div>
<!-- END FOTODATEN -->
