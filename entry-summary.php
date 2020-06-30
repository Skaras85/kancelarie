<div class="entry-summary">
	<div class="post-excerpt">
		<?php
			if(!has_category(2))
			{
				$words_count = 20;
				if(is_archive())
				{
					$words_count = 10;
				}
				
		 		echo get_custom_excerpt($words_count); 
			}
	    ?>
	</div>
	<?php if ( is_search() ) { ?>
		<div class="entry-links"><?php wp_link_pages(); ?></div>
	<?php } ?>
	
	<?php
		$tags = get_the_tags(get_the_ID());
		if(!empty($tags)) :
	?>
		<ul class="post-tags">
			<?php
				foreach($tags as $tag)
				{
					echo "<li><a href='".get_tag_link($tag->term_id)."' rel='tag'>#".$tag->name."</a></li>";
				}
			?>
		</ul>
	<?php endif; ?>
</div>