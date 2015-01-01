<div class="wrap">
<div class="opleft">
<h2><strong><?php echo _FTL_PLUGIN_NAME; ?></strong></h2>
<p>&nbsp;</p>
<form method="post" action="<?php echo admin_url( 'options.php' ); ?>" novalidate="novalidate">
    
    <?php
		/*show fields, view functions:
		 ftl_admin_init()
		 ftl_field_evanto_username_description()
		 ftl_field_evanto_username_input()*/
		wp_nonce_field( 'update-options' );
        settings_fields( _FTL_PLUGIN_SLUG );
        do_settings_sections( _FTL_PLUGIN_SLUG );
    ?>
    
    <?php submit_button(); ?>
    <p><img src="http://extras.envato.com/wp-content/uploads/2011/07/EnvatoAPI_small.png" style="width:200px" /></p>
</form>
</div>

</div>