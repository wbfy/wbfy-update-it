<?php
/**
 * Update It! WP Admin options page template
 */
?>
<div class="wrap">
	<h1>
		<?php esc_html_e('Configure Update It!', 'wbfy-update-it');?>
	</h1>
	<form method="post" action="options.php" name="wbfy-update-it-admin" class="wbfy-update-it-admin">
<?php
settings_fields('wbfy_ui_options');
do_settings_sections('wbfy_ui_options');
submit_button();
?>
	</form>
</div>
