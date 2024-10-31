<?php
/*  
 * RB Photo Gallery
 * Version:           1.0.2 - 47271
 * Author:            RBS
 * Date:              20/06/2017
 */

if( !defined('WPINC') || !defined("ABSPATH") ){
	die();
}

if ( isset( $_POST['submit'] ) ) {
	check_admin_referer( 'photo-gallery-rb-options' );
	$this->options['enable_everywhere'] = ( $_POST['mode'] == 'enable_everywhere' );
	$this->save_options();
}
?>
<style> .indent {padding-left: 2em} </style>
<div class="wrap">
	<h1><?php _e( 'Photo Gallery RB', 'photo-gallery-rb'); ?></h1>
	<p>
		Here you can configure your photo gallery  tools. Section with all configuration settings of this tool.
	</p>
	<form action="" method="post" id="photo-gallery">
		<ul>
			<li>
				<label for="enable_everywhere">
					<input type="radio" id="enable_everywhere" name="mode" value="enable_everywhere" <?php checked( $this->options['enable_everywhere'] );?> /> 
					<strong>
						<?php _e( 'Disable'); ?>
					</strong>
				</label>			
			</li>
			<li>
				<label for="rb_photo_gallery_off">
					<input type="radio" id="rb_photo_gallery_off" name="mode" value="rb_photo_gallery_off" <?php checked( !$this->options['enable_everywhere'] );?> /> 
					<strong>
						<?php _e( 'Enable'); ?>
					</strong>
				</label>
			</li>
		</ul>
		<?php wp_nonce_field( 'photo-gallery-rb-options' ); ?>
		<p class="submit">
			<input class="button-primary" type="submit" name="submit" value="<?php _e( 'Save Changes') ?>">
		</p>
	</form>
</div>
