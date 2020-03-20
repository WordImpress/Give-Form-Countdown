<?php
/**
 * Filter the countdown clock time constraints.
 *
 * @since 1.0
 * @todo  : Refactor javascript code.
 * @todo  : Add months time constraint.
 */

$form_meta = get_post_meta($form_id);
$theme = $form_meta['form-countdown-theme'][0];
$custom_styles = gfc_output_custom_color_scheme($form_id);

$date = $form_meta['form-countdown-on-date'][0] . ' ' . $form_meta['form-countdown-on-time'][0];
 
//Create a new DateTime object using the date string above.
$dateTime = new DateTime($date);
 
//Format it into a Unix timestamp.
$timestamp = $dateTime->format('U');

if ($theme == 'custom') {
	echo $custom_styles;
}

?>
<div id="gfc-clock-<?php echo $form_id; ?>-wrap" class="gfc-clock-wrap">
	<div id="flipdown-<?php echo $form_id; ?>" class="flipdown"></div>
	<div class="gfc-closed-message" style="display:none; margin: 1em 0; overflow:hidden;"><?php echo $form_meta['form-countdown-message'][0]?></div>
</div>

<script>
	document.addEventListener('DOMContentLoaded', () => {

		var twoDaysFromNow = (new Date().getTime() / 1000) + (86400 * 2) + 1,
			fiveSeconds = (new Date().getTime() / 1000) + 5,
			closedMessage = 
			formwrap = document.getElementById("give-form-<?php echo $form_id?>-wrap");
		
		//Testing
		//var flipdown = new FlipDown(fiveSeconds,'flipdown-<?php echo $form_id; ?>', {theme: '<?php echo $theme; ?>'})

		var flipdown = new FlipDown(<?php echo $timestamp; ?>,'flipdown-<?php echo $form_id; ?>', {theme: '<?php echo $theme; ?>'})

		.start()

		// Do something when the countdown ends

		.ifEnded(() => {
			jQuery(formwrap).fadeOut(500);
			jQuery('.gfc-closed-message').fadeIn(1000);
  		});
	});

	function hideGiveForm() {
		var formwrap = document.getElementById("give-form-<?php echo $form_id?>-wrap");
		if (formwrap.style.display === "block") {
			formwrap.style.display = "none";
		} else {
			formwrap.style.display = "block";
		}
	}
</script>
