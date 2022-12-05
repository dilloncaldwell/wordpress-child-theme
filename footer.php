<?php wp_footer(); ?>
    </div> <!-- #page -->
    </div> <!-- #main .wrapper -->
    
    <footer>
    <div class="container">
        <div class="row">
            <div class="col">
            <?php
							if (has_custom_logo()){
								the_custom_logo();
							}else{ ?>
								<h1 class="site-title h-100 ">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo('name');?></a>
								</h1>
						<?php } ?>

            </div>
            <div class="col">
                <h3>Contact Info</h3>
                <div class="links ">
                    <a href="#">000-000-0000</a>
                    <a href="#">email@emailaddress.com</a>
                </div>
            </div>
            <div class="col">
                <h3>Quick Links</h3>
                <?php
							wp_nav_menu(array(
								'theme_location' => 'footer-menu-1',
								'container' => false,
								'menu_class' => 'footer-nav-menu',
								'fallback_cb' => '__return_false',
								'items_wrap' => '<ul id="%1$s" class="navbar-nav mb-1 mb-md-0 %2$s">%3$s</ul>',
								'depth' => 3,
								'a_class' => 'dropdown-item',
								'walker' => new bootstrap_5_wp_nav_menu_walker()
							));
							?>
            </div>
        </div>
    </div>

    <div class="footer-copyright">
        <p><small>&copy;<?php echo date("Y"); ?> Business Name | All Rights Reserved.</small></p>
    </div>

    </footer>
    
</body>
</html>