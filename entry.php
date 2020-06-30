<article id="post-<?php the_ID(); ?>" <?php post_class(is_singular() && !isset($is_singular) ? 'single' : ''); ?>>
	<?php
		if(has_category(3) && !isset($is_singular))
			echo '<p class=""></p><div class="clear"></div>';
	?>
	<div class="author-content-wrapper clearfix">
		
		<div class="post-content">
			<header>
				<?php 
					if(has_category(2)) :
						echo '<div class="logo-wrapper-top">';
							echo get_the_post_thumbnail(get_the_ID(), is_singular() && !isset($is_singular) ? 'medium_large' : 'thumbnail');
							echo '<a href="" class="button show-contact-form">Skontaktuj się z kancelarią</a>';
							echo '<div class="contact-form">';
								echo do_shortcode('[Form id="8"]');
							echo '</div>';
						echo '</div>';
					endif;
					$post_categories = get_the_category(get_the_ID());
					if(!has_category(2)) :
				?>
				<ul class="cat-links">
					<?php
		
						foreach($post_categories as $post_category)
						{
							if($post_category->category_parent!=0)
							{
								echo "<li><a href='".get_category_link($post_category->term_id)."?wszystkie=1' rel='category tag'>".$post_category->name."</a></li>";
							}
						}
					?>
				</ul>
				<?php endif; ?>
				<?php if ( has_post_thumbnail() && !isset($is_singular) && (!is_archive() || has_category(2) )  || is_archive() && has_category(4)) : ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="post-image-link">
						<?php 
							if(!empty(get_the_post_thumbnail()))
							{
								the_post_thumbnail('medium');
							} 
							else
							{
								$id_pracownika = get_post_meta(get_the_ID(), 'zalezne_od_pracownika', true);

								if(!empty($id_pracownika))
								{
									$thumbnail = get_the_post_thumbnail($id_pracownika, 'medium');
								}
								
								if(empty($thumbnail))
								{
									$thumbnail = get_the_post_thumbnail($post->ID, 'medium');
								}
								
								if(empty($thumbnail))
								{
									$thumbnail = get_the_post_thumbnail(4859, 'medium');
								}
								
								echo $thumbnail;
							}
						?>
					</a>
				<?php endif; ?>
				
				<?php 
					if(has_category(3))
					{
						$id_kancelarii = get_post_meta(get_the_ID(), 'zalezne_od_kancelarii', true);
						$kancelaria = get_post($id_kancelarii);
						
						echo '<a href="'.get_permalink($id_kancelarii).'" class="team-member-office-logo">'.get_the_post_thumbnail($id_kancelarii).'</a>';
						echo '<p class="team-member-title first">Imię i nazwisko:</p>';
					}
				?>
				
				<?php 
					if (is_singular() && !isset($is_singular))
					{
						echo '<h1 class="entry-title">';
					}
					else
					{
						echo '<h2 class="entry-title">';
					}
				?>
				
				<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" rel="bookmark"><?php the_title(); ?></a>
				
				<?php 
					if (is_singular() && !isset($is_singular)) 
					{
						echo '</h1>';
					}
					else
					{
						echo '</h2>';
					}
					
					if(has_category(2) && !is_singular())
					{
						echo '<p class="office-city">'.get_post_meta($post->ID, 'miasto', true).'</p>';
						echo '<a href="'.get_the_permalink().'" class="office-more">więcej informacji</a>';
					}
					
					if(has_category(3))
					{
						echo '<div class="team-member-data"><p class="team-member-title">Kancelaria:</p>';
						echo '<p><a href="'.get_permalink($id_kancelarii).'">'.$kancelaria->post_title.'</a></p>';
						echo '<p class="team-member-title">Funkcja:</p>';
						echo '<p>'.str_replace('<br />', ' / ', nl2br(get_post_meta($post->ID, 'funkcja_pracownika', true))).'</p>';
						
						$specjalizacje = get_post_meta($post->ID, 'specjalizacje_pracownika', true);
						
						if(!empty($specjalizacje))
						{
							echo '<p class="team-member-title">Specjalizacje:</p>';
							echo '<p>'.$specjalizacje.'</p>';
						}
						
						if(!empty(get_the_content(get_the_ID())))
						{
							echo '<p class="team-member-title">Kariera:</p>';
							
							echo apply_filters( 'the_content', get_the_content(get_the_ID()));
						}
						if(has_excerpt(get_the_ID()))
						{
							echo '<p class="team-member-title">Sukcesy:</p>';
						
							echo apply_filters( 'the_excerpt', get_the_excerpt(get_the_ID()));
						}
						
						echo '</div>';
					}
				?> 
			</header>
			<?php if(!has_category(3)) : ?>
			<?php get_template_part( 'entry', ( is_front_page() || is_home() || is_front_page() && is_home() || is_archive() || is_search() || isset($is_singular) ? 'summary' : 'content' ) ); ?>
			<?php endif; ?>
		</div>
		<div class="post-author">
			<?php
				if(!has_category(2))
				{
					$id_autora = get_post_meta($post->ID, 'zalezne_od_pracownika', true);

					$id = false;
					if(!empty($id_autora) && has_post_thumbnail($id_autora))
					{
						$id = $id_autora;
					}
						
					if(empty($id) && has_post_thumbnail($post->ID))
					{
						$id = $post->ID;
					}
						
					if(empty($id))
					{
						$id = 4859;
					}
					
					echo '<img src="'.get_the_post_thumbnail_url($id, is_singular() && !isset($is_singular) ? 'medium_large' : 'thumbnail').'" class="wp-post-image" alt="">';

					if(has_category(3))
					{
						echo '<a href="" class="button show-contact-form">Skontaktuj się</a>';
						echo '<div class="contact-form">';
							echo do_shortcode('[Form id="7"]');
						echo '</div>';
					}

					if(is_singular() && !isset($is_singular) && !has_category(3))
					{
						if((has_category(4) || !has_category(4)) && !has_category(1) )
						{
							if(!empty($id_autora))
							{
								$author = get_post($id_autora);
								echo '<div class="author-data"><p class="author-name">';
								
								if($author->post_status=='publish')
								{
									echo '<a href="'.get_permalink($author->ID).'">';
								}
								
								echo $author->post_title;
								
								if($author->post_status=='publish')
								{
									echo '</a>';
								}
								
								echo '</p>';
								
								$funkcja_pracownika = get_post_meta($author->ID, 'funkcja_pracownika', true);
								echo '<p class="author-function">'.$funkcja_pracownika.'</p>';
								
								$id_kancelarii = get_post_meta($author->ID, 'zalezne_od_kancelarii', true);
								
								if(empty($id_kancelarii))
								{
									$id_kancelarii = get_post_meta($post->ID, 'zalezne_od_kancelarii', true);
								}
								
								if(!empty($id_kancelarii))
								{
									$kancelaria = get_post($id_kancelarii);
									
									echo '<p class="author-office"><a href="'.get_permalink($id_kancelarii).'">'.$kancelaria->post_title.'</a></p>';
								}
								else
								{
									$kancelaria = get_post_meta($author->ID, 'zalezne_od_kancelarii2', true);
									
									if(!empty($kancelaria))
										echo '<p class="author-office">'.$kancelaria.'</p>';
								}
							}

							echo '<a href="" class="button show-contact-form">Skontaktuj się z autorem</a>';
							echo '<div class="contact-form">';
								echo do_shortcode('[Form id="7"]');
							echo '</div>';
						}
		
		
						if(!has_category(1))
						{
							echo '<ul class="category-list">';
							
							$categories = get_categories(array('parent' => 4, 'hide_empty'=>0));
			
							foreach($categories as $category)
							{
								echo "<li><a href='".get_category_link($category->term_id)."?wszystkie=1' class='".(has_category($category->term_id, $post->ID) ? 'active' : '')."'>".$category->name ."</a></li>";
							}
							
							echo '</ul></div>';
						}
					}
				}
				else
				{
					echo '<div class="logo-wrapper">';
						echo get_the_post_thumbnail(get_the_ID(), is_singular() && !isset($is_singular) ? 'medium_large' : 'thumbnail');
						echo '<a href="" class="button show-contact-form">Skontaktuj się z kancelarią</a>';
						echo '<div class="contact-form">';
							echo do_shortcode('[Form id="7"]');
						echo '</div>';
					echo '</div>';
				}
			?>
		</div>
	</div>

	<?php if(has_category(3) && !isset($is_singular) && is_singular() ): ?>
		<div class="author-articles">
			<div class="author-articles-new">
				<p class="highlighted-title">Najnowsze</p>
				<?php
					$is_article = true;
					$query = new WP_Query(array('posts_per_page'=>3,
												'cat'=>4,
											    'post_type' => 'post',
											    'meta_key'=>'zalezne_od_pracownika',
												'meta_value'=>$post->ID));

					if(!$query->have_posts())
					{
						$query = new WP_Query(array('posts_per_page'=>3,
												'cat'=>4,
											    'post_type' => 'post')
											  );
					}
				?>
				
				<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php set_query_var( 'is_singular', 1 ); ?>
				<?php set_query_var( 'is_article', 1 ); ?>
				<?php get_template_part( 'entry' ); ?>
				<?php endwhile; endif; ?>
			</div>
			
			<div class="author-articles-office">
				<?php
					$query = new WP_Query(array('posts_per_page'=>3,
												'cat'=>4,
											    'post_type' => 'post',
											    'meta_key'=>'zalezne_od_kancelarii',
											    'meta_value'=>$id_kancelarii));
												
					if($query->have_posts())
					{
						echo '<p class="highlighted-title">Artykuły kancelarii</p>';
					}
												
				?>
				
				<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
				<?php set_query_var( 'is_singular', 1 ); ?>
				<?php set_query_var( 'is_article', 1 ); ?>
				<?php get_template_part( 'entry' ); ?>
				<?php endwhile; endif; ?>
			</div>
		</div>
	<?php endif; ?>
</article>
<?php if(has_category(4) && !isset($is_singular) && is_singular() && !isset($is_article) ): ?>
	<div class="recomended-posts">
		<p class="highlighted-title">Artykuły z tej kategorii</p>
		<div class="clear"></div>
		<?php
	
			$kategoria = array();
	
			foreach($post_categories as $categoria)
			{
				if($categoria->term_id!=4)
				{
					array_push($kategoria, $categoria->term_id);
				}
			}
		
			$args = array('post_type' => 'post',
						   'orderby'=>'rand',
						   'category__in' => $kategoria,
						   'post__not_in'=>array(get_the_ID()),
						   'posts_per_page'=>3);
						   
			$query = new WP_Query($args);
			
			if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post();
				set_query_var( 'is_singular', 1 );
				get_template_part( 'entry' );
			endwhile; endif;
		?>
	</div>
<?php endif; ?>
	<?php if(has_category(2) && is_singular() && !has_category(3)) : ?>
		<div class="team-wrapper">
			<p class="highlighted-title">Zespół</p>
			<div class="team">
				<?php
					$pracownicy = get_posts(array('post_type' => 'post',
											'numberposts'=>-1,
											'orderby'=>'menu_order, publish_date',
											'order'=>'DESC',
											'cat'=>3,
											'meta_key'         => 'zalezne_od_kancelarii',
        									'meta_value'       => get_the_ID()
											));
					
					if(!empty($pracownicy))
					{
						foreach($pracownicy as $pracownik)
						{
							echo '<div class="team-member"><a href="'.get_permalink($pracownik->ID).'">';
							
							echo get_the_post_thumbnail($pracownik->ID, 'medium_large');
							echo '<p class="team-member-name">'.$pracownik->post_title.'</p>';
							echo '<p class="team-member-function">'.nl2br(get_post_meta($pracownik->ID, 'funkcja_pracownika')[0]).'</p>';
							
							echo '</a></div>';
						}
					}
				?>
			</div>
			<div class="next-button"></div>
			<div class="prev-button"></div>
		</div>
<?php endif; ?>