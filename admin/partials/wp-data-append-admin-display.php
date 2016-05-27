<div class="wrap wp-data-append-settings" ng-app="wpDataAppendSettings">
    <h2><span class="dashicons dashicons-chart-line"></span> <?php echo esc_html( get_admin_page_title() ); ?></h2>
    <p class="description">Use this settings page to configure data appends. Once you save your WealthEngine and TowerData credentials, add a Gravity Forms object and map the form fields appropriately. Once saved, hidden fields for WealthEngine and TowerData appends will be added to the Gravity Froms object if they do not already exist.</p>

    <form action="options.php" method="post">
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Update Settings" 
            ng-disabled="formsToAppendForm.$invalid">
        <?php        	
            settings_fields( $this->plugin_name );
            do_settings_sections( $this->plugin_name );            
        ?>
    </form>
</div>