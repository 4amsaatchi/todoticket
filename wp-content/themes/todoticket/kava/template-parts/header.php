<?php
/**
 * Template part for default Header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kava
 */
?>


<div class="contenedor-menu">
	<?php do_action( 'kava-theme/header/before' ); ?>
	<div class="row-menu">
		<div <?php kava_site_branding_class(); ?>>
			<?php kava_header_logo(); ?>
		</div>
		<?php kava_main_menu(); ?>
		<?php if ( has_nav_menu( 'social' ) ) :?>
			<div class="socialheadermenu fuerade-menu">
				<?php $items = wp_get_nav_menu_items(61);
				foreach ($items as $item) :?>
					<div class="singlesocialheader txtcenter">
						<a href="<?= $item->url ?>" target="_blank">
							<i class="fa <?= $item->classes[0] ?>"></i>							
						</a>
					</div>
				<?php 					
				endforeach;	?>
			</div>
			<?php
		endif;
		?>
	</div>
</div>
<script>
jQuery(document).ready(function($){
	if ($(window).width() <= 767) {
	    $(".menu-item-has-children").append("<div class='open-menu-link open itemvisible'>+</div>");
	    $('.menu-item-has-children').append("<div class='open-menu-link close'>-</div>");
	
	    /*$('.close').addClass('invisible');*/

		$('.open-menu-link.open').on('click', function () {
		    $(this).toggleClass('itemvisible');
		    $('.open-menu-link.close').toggleClass('itemvisible');
		});


		$('.open-menu-link.close').on('click', function () {
		    $(this).toggleClass('itemvisible');
		    $('.open-menu-link.open').toggleClass('itemvisible');
		});
	
	    $('.open-menu-link').click(function(e){
	    		/*$('.close').removeClass('invisible');
	    		$('.close').addClass('visible');
	    		$('.open').addClass('invisible');*/
	        var childMenu =  e.currentTarget.parentNode.children[1];
	        if($(childMenu).hasClass('visible')){
	            $(childMenu).removeClass("visible");
				$(childMenu).addClass('invisible');

	            /*$(e.currentTarget.parentNode.children[2]).addClass("visible");*/
	            $(e.currentTarget.parentNode.children[3]).removeClass("visible");
	            $(e.currentTarget.parentNode.children[3]).removeClass("invivisible");
	        } else {
	            $(childMenu).addClass("visible");
	            $(childMenu).removeClass("invisible");
	
	            /*$(e.currentTarget.parentNode.children[2]).addClass("visible");*/
	            $(e.currentTarget.parentNode.children[3]).removeClass("visible");
	            /*$(e.currentTarget.parentNode.children[2]).removeClass("invivisible");*/
	        }
	    });
    }
});
</script>