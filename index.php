<?php get_header(); ?>
<main id="content" role="main">
	<div class="search-cats">
		<form>
			<label for="categoriesSelect">Artykuły</label><!--
			--><div class="select-wrapper"><p>(Wybierz z listy)</p><select id="categoriesSelect">
				<option value=""> </option>
				<?php
					$categories = get_categories(array('parent' => 4, 'hide_empty'=>0));

					foreach($categories as $category)
					{
						echo "<option value='".$category->slug ."'>".$category->name ."</option>";
					} 
				?>
			</select></div>
		</form>
	</div>
	<div id="main-left">
		<div class="highlighted-post-wrapper">
			<?php
				$sticky = get_option( 'sticky_posts' );
				$args = array('post_type' => 'post',
							   'orderby'=>'menu_order',
							   'post__in' => $sticky,
							   'cat' => 4);

				$query = new WP_Query(array_merge($args, array('posts_per_page'=>1)));

			?>
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
			<?php get_template_part( 'entry' ); ?>
			<?php endwhile; endif; ?>
		</div>
		<div class="secondary-posts clearfix">
			<?php

				$query = new WP_Query(array_merge($args, array('posts_per_page'=>2, 'offset'=>1)));

			?>							
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
			<?php get_template_part( 'entry' ); ?>
			<?php endwhile; endif; ?>
			
		</div>
	</div>
	<div id="main-right">
		<div class="author-posts clearfix">
			<?php
				$query = new WP_Query(array_merge($args, array('posts_per_page'=>2, 'offset'=>3)));
			?>							
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
			<?php get_template_part( 'entry' ); ?>
			<?php endwhile; endif; ?>
			
		</div>
		<div class="other-posts">
			<?php
				$query = new WP_Query(array_merge($args, array('posts_per_page'=>10, 'offset'=>5)));
			?>							
			<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
			<?php get_template_part( 'entry' ); ?>
			<?php endwhile; endif; ?>
		</div>
	</div>
	<div class="clear"></div>
	<div class="center"><p class="office-web-title">SIEĆ KANCELARII PRAWNYCH POD PARTONATEM "RZECZPOSPOLITEJ"</p></div>
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
	<div class="center highlighted-title-wrapper"><p class="highlighted-title">Korzyści z przystąpienia do sieci Kancelarii RP</p></div>
	<div class="benefits-wrapper">
		<div class="benefit">
			<img src="<?php echo get_stylesheet_directory_uri() ?>/img/marketing.svg" class="benefit_icon" alt="">
			<?php
				$post = get_post(182);
				echo '<h3>'.$post->post_title.'</h3>';
				echo apply_filters('the_content', $post->post_content);
			?>
		</div>
		<div class="benefit">
			<img src="<?php echo get_stylesheet_directory_uri() ?>/img/dzialalnosc.svg" class="benefit_icon" alt="">
			<?php
				$post = get_post(186);
				echo '<h3>'.$post->post_title.'</h3>';
				echo apply_filters('the_content', $post->post_content);
			?>
		</div>
		<div class="benefit">
			<img src="<?php echo get_stylesheet_directory_uri() ?>/img/zespol.svg" class="benefit_icon" alt="">
			<?php
				$post = get_post(184);
				echo '<h3>'.$post->post_title.'</h3>';
				echo apply_filters('the_content', $post->post_content);
			?>
		</div>
		<a href="<?php echo get_permalink(734); ?>" class="button">Poznaj więcej korzyści</a>
	</div>
</main>
<?php get_footer(); ?>