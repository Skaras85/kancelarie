<?php 
	get_header();
	global $wp;
 ?>
<main id="content" role="main" class="<?php echo !empty($_GET['wszystkie']) ? 'all-posts' : ''; ?>">
	<header class="header">
		<?php if(has_category(4)) : ?>
			<div class="search-cats">
				<form action="<?php echo esc_url( home_url( '/' )).$wp->request;  ?>">
					<input type="hidden" name="wszystkie" value="1">
					<label for="categories-select">Kategorie</label><!--
					--><div class="select-wrapper"><p><?php echo get_queried_object()->name=='Artykuły' ? 'Artykuły (wybierz z listy)' : get_queried_object()->name; ?></p><select id="categories-select">
						<option> </option>
						<?php
							$categories = get_categories(array('parent' => 4, 'hide_empty'=>0));
		
							foreach($categories as $category)
							{
								echo "<option value='".$category->slug ."'";
								
								if(get_queried_object()->term_id==$category->term_id)
								{
									echo ' selected';
								}
								
								echo ">".$category->name ."</option>";
							} 
						?>
					</select></div><!--
					--><div class="text-wrapper"><!--
					--><input type="text" name="s" placeholder="Wpisz frazę"><!--
					--><input type="submit" value="Szukaj"><!--
					--></div>
				</form>
			</div>
		<?php endif; ?>
		<?php if(has_category(2)) : ?>
			<div class="search-cats">
				<form>
					<label for="categories">Nasi partnerzy</label><!--
					--><div class="select-wrapper"><p><?php echo isset($_GET['wojewodztwo']) ? $_GET['wojewodztwo'] : 'województwo'; ?></p><select id="province-select">
						<option value=''>województwo</option>
						<?php
							$wojewodztwa = array('dolnośląskie','kujawsko-pomorskie','lubelskie','lubuskie','łódzkie','małopolskie','mazowieckie','opolskie','podkarpackie','podlaskie','pomorskie','śląskie','świętokrzyskie','warmińsko-mazurskie','wielkopolskie','zachodniopomorskie');

							foreach($wojewodztwa as $wojewodztwo)
							{
								echo "<option value='".$wojewodztwo."' ".(isset($_GET['wojewodztwo']) && $_GET['wojewodztwo']==$wojewodztwo ? ' selected' : '').">".$wojewodztwo."</option>";
							} 
						?>
					</select></div><!--
					--><div class="select-wrapper"><p><?php echo get_queried_object()->name!='Kancelarie' ? get_queried_object()->name : 'wybierz specjalizację'; ?></p><select id="specialization-select">
						<option value=''>specjalizacja</option>
						<?php
						
							$specjalizacje = get_categories(array('parent'=>2));

							if(!empty($specjalizacje))
							{
								foreach($specjalizacje as $specjalizacja)
								{
									if($specjalizacja->parent!=0)
									{
										echo "<option value='".$specjalizacja->slug."' ".((get_queried_object()->term_id==$specjalizacja->term_id) ? 'selected' : '').">".$specjalizacja->name."</option>";
									}
								}
							}
						?>
					</select></div>
				</form>
			</div>
		<?php endif; ?>
	</header>
	
	<?php if(!has_category(4)) : ?>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'entry' ); ?>
			<?php endwhile; ?>
		<?php else: ?>
			<p>Brak wyników</p>
		<?php endif; ?>
	<?php elseif(!empty($_GET['wszystkie'])): ?>
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
				<?php

					$args = array('post_type' => 'post',
							   		'orderby'=>'publish_date',
							   		'order'=>'DESC',
							   		'cat' => get_queried_object()->term_id);
									
					$query = new WP_Query(array_merge($args, array('posts_per_page'=>6)));
				?>
				<div id="main-left">
					<div class="secondary-posts clearfix">
						<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
						<?php get_template_part( 'entry' ); ?>
						<?php endwhile; ?>
					</div>
					
				</div>
				<div id="main-right">
					<div class="author-posts margin-top-70 clearfix">
						<?php
							$query = new WP_Query(array_merge($args, array('posts_per_page'=>7, 'offset'=>6)));
						?>							
						<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
						<?php get_template_part( 'entry' ); ?>
						<?php endwhile; endif; ?>
					</div>
				</div>
				<div class="center clear">
					<a style="margin-top: 50px;" href="<?php echo esc_url( home_url( '/' )).$wp->request;  ?>?wszystkie=1" class="button">Wczytaj wszystkie artykuły</a>
				</div>
		<?php else: ?>
			<p>Brak wyników</p>
		<?php endif; ?>
	<?php endif; ?>
	<?php 
		if(!has_category(4) || !empty($_GET['wszystkie']))
		{
			get_template_part( 'nav', 'below' ); 
		}
	?>
</main>
<?php get_sidebar(); ?>
<?php get_footer(); ?>