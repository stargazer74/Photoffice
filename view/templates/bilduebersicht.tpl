<!-- BEGIN BILDUEBERSICHT -->
<script type="text/javascript">
$(document).ready(function() {
	$(".singleimage").fancybox();	
	$("a.gruppe").fancybox({
		'transitionIn'	:	'elastic',
		'transitionOut'	:	'elastic',
		'speedIn'		:	600, 
		'speedOut'		:	200, 
		'overlayShow'	:	false
	});
	
});
</script>
	<!-- BEGIN BILD -->
		<div class="margin_left_10 margin_top_10 x_small bold float_left aeussere_bildbox">			
			<div class="border passepartout_bildicon">
				<div class="innere_bildbox">
					<a rel="gruppe" class="singleimage" href="./view/images/galeriebilder/{GALERIEID}/{BILDNAME}"><img onMouseOver="javascript:showPictureDetails({PICTUREID})" src="./view/images/galeriebilder/{GALERIEID}/{EINZELBILD}" /></a>
				</div>
			</div>
			<p>{BILDNAME}</p>
			<a class="delete_picture_button" href="javascript:void()" onclick="delete_picture('bild', {PICTUREID})"></a>
		</div>
	<!-- END BILD -->
<!-- END BILDUEBERSICHT -->

<!-- BEGIN KEINBILD -->
<h2 class="margin_top_10 margin_left_10">Es gibt noch keine Bilder in dieser Galerie.</h2>
<!-- END KEINBILD -->