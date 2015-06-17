<?php  global $nav_options; ?>
<div class="hidden-mobile">
		<nav class="sm-navbar supermenu animated" role="navigation">
			<div class="sm-container">
				<div class="sm-navbar-header">
					<a class="desktop_logo sm-navbar-brand" href="<?= home_url(); ?>">
						<img src="data:image/gif;base64,R0lGODlhAQABAAD/ACwAAAAAAQABAAACADs=" />
					</a>
				</div><!--.sm-navbar-header-->

				<?php //Menu items
					wp_nav_menu( array(
						'menu'              => '',
						'theme_location'    => '',
						'depth'             => 3,
						'limit_depth'      => false,
						'container'         => 'div',
						'container_class'   => 'collapse sm-navbar-collapse',
						'container_id'      => 'supermenu-sm-navbar-collapse',
						'items_wrap'        => '<ul class="sm-nav sm-navbar-nav navbar-right animated">%3$s</ul>',
						'link_before'     => '<span class="menu-item-name">',
						'link_after'      => '</span>',
						'fallback_cb'       => 'sm_bootstrap_navwalker::fallback',
						'walker'            => new sm_bootstrap_navwalker())
					);
					?>
			</div><!--.container-->			
		</nav>
</div><!--.hidden-mobile-->