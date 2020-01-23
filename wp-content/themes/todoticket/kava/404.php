<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package Kava
 */

get_header(); ?>

<div class="container min-heigth">
	<div class="error">
		
			<div class="num-404">
			404	<div class="co">	
				<small style="width: 100%">	Error</small>
				<div class="num">404</div>
				</div>
			</div>
			<div class="page-no-found">
				<?php $currentlang = get_bloginfo('language'); if($currentlang=="en-US"):?>Page not found<?php else: ?>Página no encontrada<?php endif; ?>
			</div>
			<a href="http://138.197.102.237/todoticket/" class="error-button">Regresar</a>
		
	</div><!-- #primary -->
</div><!-- .wrap -->
<style>
	.error {
	    flex-direction: column;
	    justify-content: center;
	    align-items: center;
	    margin-bottom: 30px;
	}
	.num-404 {
	    font-size: 16rem;
	    color: #e2c05e26;
	    margin-bottom: -79px;
	}
	.page-no-found {
	    font-size: 18px;
	    color: #20232c;
	    letter-spacing: 2px;
	    margin-bottom: 30px;
	}
	.borde-continua {
	    width: 175px;
	    border: 2.5px solid #E42328;
	    padding: 5px;
	    border-radius: 50px;
	    transition: border .2s;
	    margin-bottom: 30px;
		position: relative;
		z-index: 2000;
	}
	.co {
	    justify-content: center;
	    align-items: center;
	    flex-direction: column;
	    position: absolute;
	    top: 0;
	    left: 0;
	    right: 0;
	    bottom: 0;
	}
	.co small {
	    color: #eabe41;
	    font-size: 24px;
	    margin-bottom: -46px;
	    width: 100%;
	}
	.num {
	    font-size: 8rem;
	    color: #eabe41;
	}
	.error {
	    display: flex;
	}
	.num-404 {
	    position: relative;
	}
	.co, .error {
	    display: flex;
	}
	.co {
	    text-align: center;
	}
	@media (max-width: 767px){
		.num-404 {
		    font-size: 13rem!important;
		}
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
</style>
<?php
get_footer();
