<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       natehobi.com
 * @since      1.0.0
 *
 * @package    Wp_Data_Append
 * @subpackage Wp_Data_Append/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap" ng-app="wpDataAppendSettings">
    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
    <p class="description">Use this settings page to configure data appends. Once you save your WealthEngine and TowerData credentials, add a Gravity Forms object and map the form fields appropriately. Once saved, hidden fields for WealthEngine and TowerData appends will be added to the Gravity Froms object if they do not already exist.</p>
    <form action="options.php" method="post">
        <?php
        	submit_button();
            settings_fields( $this->plugin_name );
            do_settings_sections( $this->plugin_name );
            echo '<hr />';
            submit_button();
        ?>
    </form>
</div>