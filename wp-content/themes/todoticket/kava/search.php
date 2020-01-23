<?php
/**
 * The template for displaying search results pages.
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
	<div class="container-fluid primary search-general" style="background: #fff;">
		<div id="primary-dos" class="content-area">
			<main id="main" class="site-main buscador" role="main">
					<?php if ( have_posts() ) : ?>
					<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
						<span class="search-page-title-color" style="color: #20232c;font-size: 26px;"><?php printf( esc_html__( 'Results for: %s', 'twentyseventeen' ), '<span>' . get_search_query() . '</span>' ); ?></span>
					<?php else: ?>
						<span class="search-page-title-color" style="color: #20232c;font-size: 26px;"><?php printf( esc_html__( 'Resultados para: %s', 'twentyseventeen' ), '<span>' . get_search_query() . '</span>' ); ?></span>
					<?php endif; ?>
					<hr style="background: #eabe41;width: 150px;margin: 16px 0;">
					<?php /* Start the Loop */ ?>
					<?php while ( have_posts() ) : the_post(); ?>
					<article class="post-item-search" id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php
							if ( is_sticky() && is_home() ) :
								echo twentyseventeen_get_svg( array( 'icon' => 'thumb-tack' ) );
								endif;
						?>
						<?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
							<div class="post-thumbnail">
							<a href="<?php the_permalink(); ?>">
						<?php the_post_thumbnail( 'twentyseventeen-featured-image' ); ?>
							</a>
							</div><!-- .post-thumbnail -->
						<?php endif; ?>

						<div class="entry-content">
							<?php echo get_the_title( $post_id ); ?>
							<p class="search-post-excerpt"><?php the_excerpt(); ?></p>
							<p class="search-post-link"><a class="btn-vermas-search" href="<?php the_permalink(); ?>"><?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>View more<?php else: ?>Ver más<?php endif; ?></a></p>
						</div><!-- .entry-content -->

							<?php
							if ( is_single() ) {
							twentyseventeen_entry_footer();
							}
						?>
					</article><!-- #post-## -->
					<?php endwhile; ?>
					<?php //the_posts_navigation(); ?>
					<?php else : ?>
					<?php //get_template_part( 'template-parts/content', 'none' ); ?>
					<?php endif; ?>

			</main>
			<?php if ( have_posts() ) : ?>
			<?php get_sidebar(); ?>
			<?php endif; ?>
		</div>
		<?php if ( !have_posts() ) : ?>
						<div class="sin-resultados container">
							<div class="header">
								<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
									<span class="search-page-title" style="text-transform: inherit !important;">No search results</span>
								<?php else: ?>
									<span class="search-page-title" style="text-transform: inherit !important;">Sin resultados de búsqueda</span>
								<?php endif; ?>
							</div>
							<div class="linea_resultado"></div>
							<style>
								.linea_resultado {
									height: 1px;
									background: #eabe41;
									width: 100px;
									margin: 15px 0 30px;
								}
							</style>
							<div class="contenido-resultados">
								<div class="container">
									<div class="row">
										<div class="col-md-12">
											<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>
												<p>We're sorry, but nothing matches your search terms. Please try again with some different keywords.</p>
											<?php else: ?>
												<p>Lo sentimos, pero nada coincide con sus términos de búsqueda. Por favor, intente de nuevo con algunas palabras clave diferentes.</p>
											<?php endif; ?>
										</div>
									</div>
								</div>
							</div>
							<br>
							<a href="http://138.197.102.237/todoticket/" class="error-button" style="padding: 10px 18px;">Regresar</a>
						</div>
					<?php endif; ?>
	</div>
	<style>
	.sin-resultados.container {
		padding: 60px 0;
	}
	span.search-page-title {
	    font-size: 28px;
	}
	.error-button {
		background: #eabe41 !important;
		text-decoration: none !important;
		min-width: 150px !important;
		width: 150px;
		border-radius: 30px !important;
		font-family: helvetica;
		font-size: 15px;
		font-weight: 500;
		text-transform: uppercase;
		background-color: rgba(0,0,0,0);
		padding: 8px;
		color: #fff;
		text-align: center;
		margin: 0 auto;
	}
	.error-button:hover {
		color: #fff;
		background-color: #9a999e !important;
	}
	.site-main.buscador {
	    width: 75% !important;
	    margin: 0 auto;
	    margin-top: 5%;
	}
	article.post-item-search {
	    width: 100% !important;
	    display: flex;
	    padding-bottom: 2%;
	    margin-bottom: 5% !important;
	    border-bottom: 1px solid #eabe41;
	}
	.post-item-search .post-thumbnail {
	    width: 25% !important;
	}
	article.post-item-search .entry-content {
	    width: 75% !important;
	}
	.btn-vermas-search {
		background: #eabe41 !important;
		text-decoration: none !important;
		min-width: 150px !important;
		width: 150px;
		border-radius: 30px !important;
		font-family: helvetica;
		font-size: 15px;
		font-weight: 500;
		text-transform: uppercase;
		background-color: rgba(0,0,0,0);
		padding: 8px;
		color: #fff;
		text-align: center;
		margin: 0 auto;
	}
	.btn-vermas-search:hover {
		color: #fff;
		background-color: #9a999e !important;
	}
	.post-item-search .post-thumbnail img {
	    border-radius: 0px !important;
	}
	article.post-item-search .entry-content {
	    width: 75% !important;
	    padding-left: 5%;
	}
	</style>
	<!-- .wrap -->
<?php get_footer(); ?>