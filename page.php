<?php get_header(); ?>
<main id="content" role="main">
	<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
		<?php if(get_the_ID()==734): ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('become-partner'); ?>>
				<h1>SIEĆ KANCELARII PRAWNYCH POD PARTONATEM "RZECZPOSPOLITEJ"</h1>
				<div class="infographics">
					<div class="info info1">
						<div class="infographics-number">1000</div>
						<div class="infographics-text">prawników i radców</div>
						<img src="<?php echo get_stylesheet_directory_uri() ?>/img/prawnicy.png" class="infographics-icon" alt="">
					</div>
					<div class="info info2">
						<div class="infographics-number">70000</div>
						<div class="infographics-text">porad rocznie</div>
						<img src="<?php echo get_stylesheet_directory_uri() ?>/img/porady.png" class="infographics-icon" alt="">
					</div>
					<div class="info info3">
						<div class="infographics-number">80</div>
						<div class="infographics-text">dziedzin prawa</div>
						<img src="<?php echo get_stylesheet_directory_uri() ?>/img/dziedziny.png" class="infographics-icon" alt="">
					</div>
					<div class="info info4">
						<div class="infographics-number">700</div>
						<div class="infographics-text">artykułów</div>
						<img src="<?php echo get_stylesheet_directory_uri() ?>/img/artykuly.png" class="infographics-icon" alt="">
					</div>
					<div class="info info5">
						<div class="infographics-number">60</div>
						<div class="infographics-text">lokalizacji</div>
						<img src="<?php echo get_stylesheet_directory_uri() ?>/img/lokalizacja.png" class="infographics-icon" alt="">
					</div>
					<div class="info info6">
						<div class="infographics-number">25000</div>
						<div class="infographics-text">umów rocznie</div>
						<img src="<?php echo get_stylesheet_directory_uri() ?>/img/umowy.png" class="infographics-icon" alt="">
					</div>
				</div>
				<hr>
				<div class="center">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/marketing.svg" alt="Wspieramy Twój marketing" class="become-partner-icon">
					<h2>Wspieramy Twój marketing</h2>
					<?php
						$post = get_post(737);
						echo '<p class="bold slab">'.$post->post_title.'</p>';
					?>
					<div class="support-marketing-wrapper clearfix">
						<div class="left">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/wspieramy-left.svg" alt="">
							<?php echo apply_filters( 'the_content', $post->post_content); ?>
						</div>
						<div class="right">
							<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/wspieramy-right.svg" alt="">
							<?php echo apply_filters( 'the_excerpt', $post->post_excerpt); ?>
						</div>
					</div>
					<div class="become-partner-possibilities">
						<?php
							$post = get_post(739);
							echo '<p class="bold">'.$post->post_title.'</p>';
							echo apply_filters( 'the_content', $post->post_content);
						?>
					</div>
					<hr>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/dzialalnosc.svg" alt="Wspieramy rozwój Twojego biznesu" class="become-partner-icon">
					<h2>Wspieramy rozwój Twojego biznesu</h2>
					<div class="become-partner-activity">
						<?php
							$post = get_post(741);
							echo '<p class="bold slab">'.$post->post_title.'</p>';
							echo '<p class="bold">'.$post->post_excerpt.'</p>';
							echo apply_filters( 'the_content', $post->post_content);
						?>
					</div>
					<hr>
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/zespol.svg" alt="Wspieramy rozwój Twojego zespołu" class="become-partner-icon">
					<h2>Wspieramy rozwój Twojego zespołu</h2>
					<div class="become-partner-team">
						<?php
							$post = get_post(743);
							echo apply_filters( 'the_content', $post->post_content);
						?>
					</div>
					<hr>
					<p class="leave-data">Zostaw swoje dane, skontaktujemy się z Tobą</p>
					<?php echo do_shortcode('[Form id="6"]'); ?>
				</div>
			</article>
		<?php elseif(get_the_ID()==232): ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class('kontakt'); ?>>
				<header class="header">
					<p class="highlighted-title">Kontakt</p>
				</header>
				<div class="entry-content clearfix">
					<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
					<div class="contact-data">
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php the_content(); ?>
					</div>
					<div class="map">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2443.709096135717!2d20.985219515685586!3d52.230502779760464!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x471ecc9ad1f3573f%3A0x89a2beb9d3b7e1bd!2sProsta%2051%2C%2000-838%20Warszawa!5e0!3m2!1spl!2spl!4v1588752860171!5m2!1spl!2spl" width="685" height="455" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
					</div>
				</div>
			</article>
		<?php elseif(get_the_ID()==3 || get_the_ID()==5197): ?>
			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="header">
					<h1 class="entry-title"><?php the_title(); ?></h1>
				</header>
				<div class="entry-content">
					<?php if ( has_post_thumbnail() ) { the_post_thumbnail(); } ?>
					<?php the_content(); ?>
				</div>
			</article>
		<?php else: ?>
			<article id="post-<?php the_ID(); ?>">
				<div class="entry-content clearfix">
					<header class="header">
						<p class="blackTitle">Wiadomość wysłana poprawnie</p>
					</header>
					<?php the_content(); ?>
				</div>
			</article>
		<?php endif; ?>
	<?php endwhile; endif; ?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>