<!-- BEGIN KUNDEN -->
<script type="text/javascript">
$(function() 
{
	$("ul.css-tabs").tabs("div.css-panes > div", {effect: 'ajax'}); 
});
</script>

<!-- tabs --> 
<ul class="css-tabs"> 
    <li><a href="./kundenliste.html" onclick="javascript:setKlappBoxVisible('kundensuchebox_visibility'); setKlappBoxVisible('kundengalerienbox_visibility'); setKlappBoxVisible('kundendatenbox_visibility')">Kundenliste</a></li> 
    <li><a href="./neukunde.html" onclick="javascript:setKlappBoxInvisible('kundensuchebox_visibility'); setKlappBoxInvisible('kundendatenbox_visibility'); setKlappBoxInvisible('kundengalerienbox_visibility')">neuer Kunde</a></li>
</ul> 
 
<!-- single pane. it is always visible --> 
<div class="css-panes"> 
    <div class="margin_10" style="display:block;" id="kundeninhalt"></div> 
</div>
<!-- END KUNDEN -->