(function($) {
 	$('.photo_gallery_rb_wrap').each(function(index, el) {
 		var options = { hideCaption : 0 };
 		if( $(this).data('hidecaption')==1 ) options.hideCaption = 1;
 		var id = $( this).attr('id');
 		$('#'+id+' a').swipebox(options);	
 	});
}(jQuery));
