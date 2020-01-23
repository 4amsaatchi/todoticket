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
<script>
    var slideIndex = 1;
    showSlides(slideIndex);

    function plusSlides(n) {
    showSlides(slideIndex += n);
    }

    function currentSlide(n) {
    showSlides(slideIndex = n);
    }

    function showSlides(n) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    var dots = document.getElementsByClassName("dot");
    if (n > slides.length) {slideIndex = 1}    
    if (n < 1) {slideIndex = slides.length}
    for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
    }
    slides[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " active";
    }
    </script>
    <script>
        jQuery( document ).ready(function(){
            jQuery(".categorias-catalogo input.jet-checkboxes-list__input").click();
        });

        jQuery('.jet-woo-products-list__item').click(function(e){
            var clickedURL = jQuery(this).find("a").attr('href');
            console.log(clickedURL);
            if (clickedURL !== null){
                window.location.href= clickedURL;
            }
            // jQuery( jQuery(this).find("a").attr('href') ).click();
            e.preventDefault(); // same to return false;
        });
    </script>
</body>
</html>
