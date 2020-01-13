<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Kava
 */

?>

	</div><!-- #content -->

	<footer id="colophon" <?php echo kava_get_container_classes( 'site-footer' ); ?>>
		<?php kava_theme()->do_location( 'footer', 'template-parts/footer' ); ?>
	</footer><!-- #colophon -->

</div><!-- #page -->

<?php wp_footer(); ?>
<script>
jQuery(document).ready(function(){
	jQuery( "a.button.product_type_simple" ).append( "<p>Ver más</p>" );
	jQuery( "a.button.product_type_variable.add_to_cart_button" ).append( "<p>Ver más</p>" );
	jQuery( "a#botton-cotizacion" ).click(function( event ) {
		event.preventDefault();
		jQuery("html, body").animate({ scrollTop: jQuery(jQuery(this).attr("href")).scrollTop().top }, 500);
		console.log("clicki");
	});
});
</script>
</body>
</html>
