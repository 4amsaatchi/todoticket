<?php
/**
 * Template part for default Header layout.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Kava
 */
?>
<script>
jQuery( document ).ready(function() {
var mainNav = document.getElementById('mainNav');
var navToggle = document.getElementById('navToggle');

// Start by adding the class "collapse" to the mainNav
//mainNav.classList.add('collapsed');

// Establish a function to toggle the class "collapse"
function mainNavToggle() {
    mainNav.classList.toggle('collapsed');
}

// Add a click event to run the mainNavToggle function
navToggle.addEventListener('click', mainNavToggle);

jQuery(".navbar-toggle").click(function(){
    jQuery(this).find("i").toggleClass("fa-times");
});

});
</script>

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
							<!-- <i class="fa <?= $item->classes[0] ?>"></i> -->
							<img src="<?php echo get_home_url(); ?>/wp-content/uploads/2020/01/<?= $item->classes[0] ?>-ico.png" alt="<?= $item->classes[0] ?>">
						</a>
					</div>
				<?php 					
				endforeach;	?>
			</div>
			<?php
		endif;
		?>
		<div class="buscador search-web">
			<button style="display: block;" id="navToggle" class="navbar-toggle style-1"><i class="fa fa-search" aria-hidden="true"></i></button>
			<div id="mainNav" class="navbar search-input collapsed">
				<form role="search" method="get" id="searchform" class="searchBox todoticket" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<label class="screen-reader-text" for="s"><?php _x( 'Search for:', 'label' ); ?></label>
					<div class="inputbuscar" style="display: inline-flex;">
						<input style="display: block;" type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Buscar..." class="buscador" />
						<button style="display: block;" type="submit" id="searchsubmit" value="x" class="banner-text-btn"/><i class="fa fa-search" aria-hidden="true"></i></button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script>
jQuery(document).ready(function($){
	if ($(window).width() <= 769) {
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