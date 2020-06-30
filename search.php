<?php get_header(); ?>
<main id="content" role="main">
<?php if ( have_posts() ) : ?>
<header class="header">
	<h1 class="entry-title"><?php printf( esc_html__( 'Wyniki wyszukiwania dla: %s', 'generic' ), get_search_query() ); ?></h1>
</header>
<?php if(!empty($_GET['wszystkie'])): ?>
		<div id="main-left" class="bulk-posts">
			<div class="author-posts clearfix">
				<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
					<?php get_template_part( 'entry' ); ?>
					<?php endwhile; ?>
				<?php else: ?>
					<p>Brak wyników</p>
				<?php endif; ?>
			</div>
		</div>
	<?php else: ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'entry' ); ?>
		<?php endwhile; ?>
	<?php endif; ?>
<?php get_template_part( 'nav', 'below' ); ?>
<?php else : ?>
<article id="post-0" class="post no-results not-found">
	<header class="header">
		<h1 class="entry-title"><?php esc_html_e( 'Nic nie znaleziono', 'generic' ); ?></h1>
	</header>
	<div class="entry-content">
		<p><?php esc_html_e( 'Niestety nic nie znaleziono. Spróbuj wpisać zapytanie inaczej.', 'generic' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</article>
<?php endif; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>