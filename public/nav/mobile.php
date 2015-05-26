<?php //Topmenu Code Begins here ?>
<div class="visible-mobile">
	<div class="<?php echo $outer_wrapper;?>">
		<nav class="sm-navbar supermenu animated <?php echo $top_menu_classes;?>" role="navigation">
			<div class="<?php echo $inner_wrapper;?>">
			
				<button type="button" class="sm-navbar-toggle tm-lines-button <?php echo $topmenu_tgl_size;?>" data-toggle="collapse" data-target="#supermenu-sm-navbar-collapse-mob">
					<span class="lines"></span>
				</button>
				
			
<!-- 				//Topmenu Image Logo  -->
				<div class="sm-navbar-header">
					<a class="sm-navbar-brand sm-navbar-brand-primary logo-visible img-logo" href="<?php echo home_url(); ?>"><?php echo $logo ?></a>
					<a class="sm-navbar-brand sm-navbar-brand-alt img-logo" href="<?php echo home_url(); ?>"><?php echo $logo_alt ?></a>	
				</div><!--.sm-navbar-header-->

				<?php 
				
		
				//Menu items, bring 'em in
					wp_nav_menu( array(
						'menu'              => $active_menu,
						'theme_location'    => $active_menu,
						'depth'             => 3,
						'limit_depth'      => false,
						'container'         => 'div',
						'container_class'   => 'collapse sm-navbar-collapse',
						'container_id'      => 'supermenu-sm-navbar-collapse-mob',
						'items_wrap'        => '<ul class="sm-nav sm-navbar-nav ' . $navbar_pos . ' animated sm-effect-' .$topmenu_link_effect . ' ' . $menu_items_amim . ' ' . $fixed_superside_icon . '">%3$s</ul>',
						'link_before'     => '<span class="menu-item-name">',
						'link_after'      => '</span>',
						'fallback_cb'       => 'sm_bootstrap_navwalker::fallback',
						'walker'            => new sm_bootstrap_navwalker())
					);
				?>
			</div><!--.container-->			
		</nav>
	</div>
</div><!--.visible-mobile-->
<?php //Topmenu Code ends here ?>