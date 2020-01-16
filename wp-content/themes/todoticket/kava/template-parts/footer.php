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
				<img src="<?php echo get_home_url(); ?>/wp-content/uploads/2020/01/Logo-blanco.png" alt="Todoticket">
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
								<!-- <i class="fa <?= $item->classes[0] ?> footeri"></i> -->
								<img src="<?php echo get_home_url(); ?>/wp-content/uploads/2020/01/<?= $item->classes[0] ?>-ico.png" alt="<?= $item->classes[0] ?>">
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
</div>