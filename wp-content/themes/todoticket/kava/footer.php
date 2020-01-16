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
var $target = jQuery(this.hash), target = this.hash;
      if (target) {
        var targetOffset = $target.offset().top - 192;
        jQuery(this).click(function(event) {
          event.preventDefault();
          jQuery(scrollElem).animate({scrollTop: targetOffset}, 400, function() {
            location.hash = targetOffset;
          });
        });
    }
</script>
</body>
</html>
