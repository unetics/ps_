<div class="visible-mobile">
		<nav class="sm-navbar supermenu animated" role="navigation">
				<button type="button" class="sm-navbar-toggle tm-lines-button" data-toggle="collapse" data-target="#supermenu-sm-navbar-collapse-mob">
					<span class="lines"></span>
				</button>
				
			
<!-- //Topmenu Image Logo  -->
				<div class="sm-navbar-header">
					<img src="<?= $nav_options['logoDesktop']['url']; ?>" />
				</div><!--.sm-navbar-header-->

				<?php 
				
		
				//Menu items, bring 'em in
					wp_nav_menu( array(
						'depth'             => 3,
						'limit_depth'      => false,
						'container'         => 'div',
						'container_class'   => 'collapse sm-navbar-collapse',
						'container_id'      => 'supermenu-sm-navbar-collapse-mob',
						'items_wrap'        => '<ul class="sm-nav sm-navbar-nav  animated">%3$s</ul>',
						'link_before'     => '<span class="menu-item-name">',
						'link_after'      => '</span>',
						'fallback_cb'       => 'sm_bootstrap_navwalker::fallback',
						'walker'            => new sm_bootstrap_navwalker())
					);
				?>		
		</nav>
</div><!--.visible-mobile-->