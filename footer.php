		</div>
		<footer id="footer" role="contentinfo">
			<?php if(is_front_page() || is_page(734)) : ?>
				<div class="footer-top">
					<div class="footer-left">
						<?php
							$post = get_post(188);
							if($post->post_status=='publish')
							{
								echo '<div><h3>'.$post->post_title.'</h3>';
								echo '<p>'.nl2br($post->post_content).'</p></div>';
								echo get_the_post_thumbnail($post->ID, 'thumbnail');
							}
						?>
					</div>
					<div class="footer-center">
						<span class="button button-secondary">Zapraszam do rozmowy</span>
					</div>
					<div class="footer-right">
						<?php
							$post = get_post(191);
							if($post->post_status=='publish')
							{
								echo get_the_post_thumbnail($post->ID, 'thumbnail');
								echo '<div><h3>'.$post->post_title.'</h3>';
								echo '<p>'.nl2br($post->post_content).'</p></div>';
							}
						?>
					</div>
				</div>
			<?php endif; ?>
			<div class="footer-bottom-wrapper">
				<div class="footer-bottom clearfix">
					<div class="footer-left">
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo.png" alt="Kanceparie RP" class="footer-logo">
						<ul>
							<?php
								$post = get_post(193);
								echo '<li>'.nl2br($post->post_content).'</li>';
								echo '<li>'.nl2br($post->post_excerpt).'</li>';
							?>
						</ul>
					</div>
					<div class="footer-center">
						<ul>
							<li><a href="https://www.facebook.com/KancelarieRP/" target="_blank" class="facebook-link"></a></li>
							<li><a href="https://www.linkedin.com/company/kancelarie-rp/" target="_blank" class="linkedin-link"></a></li>
						</ul>
					</div>
					<div class="footer-right">
						<ul>
							<li><a href="<?php the_permalink(5197); ?>">regulamin</a></li>
							<li><a href="<?php the_permalink(3); ?>">polityka prywatności</a></li>
						</ul>
						<img src="<?php echo get_stylesheet_directory_uri(); ?>/img/strzalka.png" alt="" class="goup">
					</div>
					<div class="clear"></div>
					<p class="copyrights">Copyright Kancelarie RP 2016-<?php echo date('Y'); ?> All Rights Reserved</p>
				</div>
			</div>
		</footer>
		<?php wp_footer(); ?>
	</body>
</html>