<ul class="post-tags">
	<?php
		$tags = get_the_tags(get_the_ID());

		if(!empty($tags))
		{
			foreach($tags as $tag)
			{
				echo "<li><a href='".get_tag_link($tag->term_id)."' rel='tag'>#".$tag->name."</a></li>";
			}
		}
	?>
</ul>

<?php
	if(is_singular() && !has_category(2))
	{
		echo '<p class="post-date">'.get_the_date('Y-m-d', $post->ID).'</p>';
	}
?>

<?php if(!has_category(2)) : ?>
	<ul class="post-social-wrapper">
		<li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo get_permalink(); ?>" target="_blank" class="facebook-link"></a></li>
		<li><a href="https://www.linkedin.com/shareArticle/?url=<?php echo get_permalink(); ?>" target="_blank" class="linkedin-link"></a></li>
	</ul>

	<div class="clear"></div>
	<div class="post-excerpt">
		<?php the_excerpt(); ?>
	</div>

<?php endif; ?>

<?php the_content(); ?>

<?php if(has_category(2)) : ?>
	<div class="office-data clearfix">
		<div class="office-specializations">
			<p class="bold">Specjalizacje:</p>
			<?php 
			
				$specjalizacje = get_the_category($post->ID);

				if(!empty($specjalizacje))
				{
					foreach($specjalizacje as $specjalizacja)
					{
						if($specjalizacja->parent!=0)
						{
							echo '- '.$specjalizacja->name.'<br>';
						}
					}
				}
			?>
		</div>
		<div class="office-address">
			<p class="bold">Adres:</p>
			<?php echo preg_replace('@(http(s)?://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@', '<a href="http$2://$3">$0</a>', get_post_meta($post->ID, 'adres', true)); ?>
		</div>
	</div>
<?php endif; ?>