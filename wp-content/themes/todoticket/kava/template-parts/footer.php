<?php
/**
 * The template for displaying the default footer layout.
 *
 * @package Kava
 */
?>
<div <?php kava_footer_class(); ?>>
	<div class="rowfoo">
		<div class="col-gen-4">
			<div class="logofoot">
				<?php kava_header_logo(); ?>
			</div>
			<?php dynamic_sidebar( 'sidebar-1' ); ?>	
		</div>
		<div class="col-gen-4 medio">
			<?php dynamic_sidebar( 'sidebar-2' ); ?>	
		</div>
		<div class="col-gen-4">
			<?php dynamic_sidebar( 'logo' ); ?>
			<?php if ( has_nav_menu( 'social' ) ) :?>
				<div class="socialheadermenu footer">
					<?php $items = wp_get_nav_menu_items(61);
					foreach ($items as $item) :?>
						<div class="singlesocialheader txtcenter">
							<a href="<?= $item->url ?>" target="_blank">
								<i class="fa <?= $item->classes[0] ?> footeri"></i>							
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
	<div class="rowfoo">
		<div class="col-gen-12 terminos">
			<?php dynamic_sidebar( 'sidebar-3' ); ?>
		</div>
	</div>
</div>