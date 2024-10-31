<?php
/*  
 * RB Photo Gallery
 * Version:           1.0.2 - 47271
 * Author:            RBS
 * Date:              Tue, 06 Jun 2017 14:06:16 GMT
 */

class Photo_Gallery_RB_Widget extends WP_Widget {

  function __construct(){
  		global $pagenow;
 		if( isset( $pagenow) &&  ( $pagenow=='customize.php' || $pagenow=='widgets.php' ) ) {
  			wp_enqueue_media();
			wp_enqueue_style('wp-jquery-ui-dialog');
			wp_enqueue_script('jquery-ui-dialog');
		}
	    parent::__construct(
	      'Photo_Gallery_RB_Widget',
	      __( 'Photo Gallery RB Widget', 'photo-gallery-rb' ),
	      array( 'description' => __( "Publish photo gallery on your website.", 'photo-gallery-rb' ), )
	    );
  }

  public function widget( $args, $instance ) {

  	//testing new elements
  	if(isset($_GET['photo_gallery_rb_check_elements'])){

  		//add js files
  		wp_enqueue_script( 'photo-gallery-rb-accordion-js', 	RB_PHOTO_GALLERY_URL.'assets/js/semantic/accordion.min.js', 	array( 'jquery' ), 									RB_PHOTO_GALLERY_VERSION, false );
  		wp_enqueue_script( 'photo-gallery-rb-api-js', 			RB_PHOTO_GALLERY_URL.'assets/js/semantic/api.min.js', 	array( 'jquery' ), 									RB_PHOTO_GALLERY_VERSION, false );
  		wp_enqueue_script( 'photo-gallery-rb-checkbox-js', 		RB_PHOTO_GALLERY_URL.'assets/js/semantic/checkbox.min.js', 	array( 'jquery' ), 									RB_PHOTO_GALLERY_VERSION, false );
  		wp_enqueue_script( 'photo-gallery-rb-colorize-js', 		RB_PHOTO_GALLERY_URL.'assets/js/semantic/colorize.min.js', 	array( 'jquery' ), 									RB_PHOTO_GALLERY_VERSION, false );
  		wp_enqueue_script( 'photo-gallery-rb-dimmer-js', 		RB_PHOTO_GALLERY_URL.'assets/js/semantic/dimmer.min.js', 	array( 'jquery' ), 									RB_PHOTO_GALLERY_VERSION, false );
  		wp_enqueue_script( 'photo-gallery-rb-dropdown-js', 		RB_PHOTO_GALLERY_URL.'assets/js/semantic/dropdown.min.js', 	array( 'jquery' ), 									RB_PHOTO_GALLERY_VERSION, false );
  		wp_enqueue_script( 'photo-gallery-rb-embed-js', 		RB_PHOTO_GALLERY_URL.'assets/js/semantic/embed.min.js', 	array( 'jquery' ), 									RB_PHOTO_GALLERY_VERSION, false );

  		//add css files
		wp_enqueue_style(  'photo-gallery-rb-accordion.css', 	RB_PHOTO_GALLERY_URL.'assets/css/semantic/accordion.min.css', 	array(), 											RB_PHOTO_GALLERY_VERSION, 'all' );
		wp_enqueue_style(  'photo-gallery-rb-ad.css', 			RB_PHOTO_GALLERY_URL.'assets/css/semantic/ad.min.css', 	array(), 											RB_PHOTO_GALLERY_VERSION, 'all' );
		wp_enqueue_style(  'photo-gallery-rb-breadcrumb.css', 	RB_PHOTO_GALLERY_URL.'assets/css/semantic/breadcrumb.min.css', 	array(), 											RB_PHOTO_GALLERY_VERSION, 'all' );
		wp_enqueue_style(  'photo-gallery-rb-button.css', 		RB_PHOTO_GALLERY_URL.'assets/css/semantic/button.min.css', 	array(), 											RB_PHOTO_GALLERY_VERSION, 'all' );
		wp_enqueue_style(  'photo-gallery-rb-card.css', 		RB_PHOTO_GALLERY_URL.'assets/css/semantic/card.min.css', 	array(), 											RB_PHOTO_GALLERY_VERSION, 'all' );
		wp_enqueue_style(  'photo-gallery-rb-checkbox.css', 	RB_PHOTO_GALLERY_URL.'assets/css/semantic/checkbox.min.css', 	array(), 											RB_PHOTO_GALLERY_VERSION, 'all' );
		wp_enqueue_style(  'photo-gallery-rb-comment.css', 		RB_PHOTO_GALLERY_URL.'assets/css/semantic/comment.min.css', 	array(), 											RB_PHOTO_GALLERY_VERSION, 'all' );
		wp_enqueue_style(  'photo-gallery-rb-container.css', 	RB_PHOTO_GALLERY_URL.'assets/css/semantic/container.min.css', 	array(), 											RB_PHOTO_GALLERY_VERSION, 'all' );
		wp_enqueue_style(  'photo-gallery-rb-dimmer.css', 		RB_PHOTO_GALLERY_URL.'assets/css/semantic/dimmer.min.css', 	array(), 											RB_PHOTO_GALLERY_VERSION, 'all' );
		wp_enqueue_style(  'photo-gallery-rb-divider.css', 		RB_PHOTO_GALLERY_URL.'assets/css/semantic/divider.min.css', 	array(), 											RB_PHOTO_GALLERY_VERSION, 'all' );
		wp_enqueue_style(  'photo-gallery-rb-dropdown.css', 	RB_PHOTO_GALLERY_URL.'assets/css/semantic/dropdown.min.css', 	array(), 											RB_PHOTO_GALLERY_VERSION, 'all' );
		wp_enqueue_style(  'photo-gallery-rb-embed.css', 		RB_PHOTO_GALLERY_URL.'assets/css/semantic/embed.min.css', 	array(), 											RB_PHOTO_GALLERY_VERSION, 'all' );

  	}

	wp_enqueue_script( 'photo-gallery-rb-lightbox-js', 	RB_PHOTO_GALLERY_URL.'assets/js/lightbox.js', 	array( 'jquery' ), 									RB_PHOTO_GALLERY_VERSION, false );
	wp_enqueue_script( 'photo-gallery-rb-script-js', 	RB_PHOTO_GALLERY_URL.'assets/js/script.js', 	array( 'photo-gallery-rb-lightbox-js', 'jquery' ), 	RB_PHOTO_GALLERY_VERSION, false );
	
	wp_enqueue_style(  'photo-gallery-rb-css',			RB_PHOTO_GALLERY_URL.'assets/css/style.css', 	array(), 											RB_PHOTO_GALLERY_VERSION, 'all' );

    $title = apply_filters( 'widget_title', $instance['title'] );
    $galleries_id = $instance['galleries_id'];
	$columns = $instance['columns'];
	if(!$columns) $columns = 3;
	$lightbox = $instance['lightbox'];

    echo $args['before_widget'];
    if( ! empty( $title ) )     echo $args['before_title'] . $title . $args['after_title'];

    echo '<div id="'.uniqid('photo_gallery_rb_wrap_id_').'" class="photo_gallery_rb_wrap" '.($lightbox?' data-hidecaption="1" ':'').'>';
   		echo do_shortcode('[gallery ids="'.$galleries_id.'" link="file"  columns="'.$columns.'" ]');
   	echo '</div>';
   	if(isset($_GET['photo_gallery_rb_check_elements'])){
   		echo '
   		<script type="text/javascript">
			(function ($) {
				console.log("Load new js and css");
			});
		</script>
		';
   	}
    echo $args['after_widget'];
  }


  public function form( $instance ) {

	if ( isset( $instance[ 'title' ] ) ) {
		$title = $instance[ 'title' ];
	} else {
		$title = __( 'Images', 'photo-gallery-rb' );
	}

    if ( isset( $instance[ 'galleries_id' ] ) ) {
      	$galleries_id = $instance[ 'galleries_id' ];
    } else {
      	$galleries_id = ' ';
    }

     if ( isset( $instance[ 'columns' ] ) ) {
      	$columns = $instance[ 'columns' ];
    } else {
      	$columns = 3;
    }

    ?>
    <p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>">
	 		<?php _e( 'Title' ); ?>:
		</label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
	</p>
	
	<p align="center">
		Use manage images button to select pictures for your photo gallery
	</p>

	<p align="center">

    	<button data-valuefield="<?php echo $this->get_field_id( 'galleries_id' ); ?>" class="button photo-gallery-rb-edit-button"><?php _e( 'Manage Images' ); ?></button>
   		<input type='hidden' id="<?php echo $this->get_field_id( 'galleries_id' ); ?>" name="<?php echo $this->get_field_name( 'galleries_id' ); ?>" value="<?php echo esc_attr( $galleries_id ); ?>" />
	<p>

	<p>
		<label for="<?php echo $this->get_field_id( 'columns' ); ?>"><?php _e( 'Columns:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'columns' ); ?>" name="<?php echo $this->get_field_name( 'columns' ); ?>" class="tiny-text" step="1" min="1" size="3" type="number"  value="<?php echo $columns; ?>" />
	</p>

	<p>
		<input <?php checked( $instance[ 'lightbox' ], 'on' ); ?> value='on' id="<?php echo $this->get_field_id( 'lightbox' ); ?>" name="<?php echo $this->get_field_name( 'lightbox' ); ?>" type="checkbox" >
		<label for="<?php echo $this->get_field_id( 'lightbox' ); ?>"><?php _e( 'Disable Caption', 'photo-gallery-rb' ); ?></label>
	</p>

	<script type="text/javascript">
		(function ($) {
    		$('.photo-gallery-rb-edit-button').click(function(event){
    			event.preventDefault();
    			var valField = $( '#'+$(this).data("valuefield") );
    			wp.media.gallery.edit("[gallery ids='"+valField.val()+"']").on('update', function(g){
					var id_array = [];
					$.each(g.models, function(id, img) { id_array.push(img.id); });
					valField.val(id_array.join(","));
				});
    			if(valField.val()=='' || valField.val()==' ') $('.media-frame-menu .media-menu-item').eq(2).click();
    		});
    	}(jQuery));

	</script>

    <?php
  }

  public function update( $new_instance, $old_instance ) {
	$instance = array();
	$instance['title'] = 		( ! empty( $new_instance['title'] ) ) 		? strip_tags( $new_instance['title'] ) : '';
	$instance['columns'] = 		( ! empty( $new_instance['columns'] ) ) 	? (int) $new_instance['columns'] : 3;
	$instance['lightbox'] = 	$new_instance['lightbox'];
	$instance['galleries_id'] = ( ! empty( $new_instance['galleries_id'] ) ) ? strip_tags($new_instance['galleries_id']) :  ' ';
	return $instance;
  }
}


function photo_gallery_rb_init_widget() {
  	register_widget( 'Photo_Gallery_RB_Widget' );
}

add_action( 'widgets_init', 'photo_gallery_rb_init_widget' );
