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
			<div class="socialheadermenu">
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
