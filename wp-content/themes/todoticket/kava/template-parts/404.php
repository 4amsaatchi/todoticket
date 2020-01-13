<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Kava
 */
?>

<section class="error-404 not-found">
	<header class="page-header">
		<h1 class="page-title"><?php esc_html_e( '¡Uy! Esa página no se puede encontrar.', 'kava' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">
		<p><?php esc_html_e( 'Parece que no se encontró nada en esta ubicación. Tal vez intente uno de los enlaces a continuación o una búsqueda?', 'kava' ); ?></p>

		<?php get_search_form(); ?>
	</div><!-- .page-content -->
</section><!-- .error-404 -->
