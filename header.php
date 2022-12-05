<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php wp_title(); ?> <?php bloginfo('name'); ?></title>
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

	<header>
		<div class="container">
			<div class="row w-100">

				<!-- Logo or site title -->
			<!-- <div class="col">
				<?php
				if (has_custom_logo()){
					the_custom_logo();
				}else{ ?>
					<h1 class="site-title">
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo('name');?></a>
					</h1>
				<?php } ?>
			</div>  -->
			<!-- end col -->

			<div class="col col-sm-12">
				<!-- Navigation -->
				<nav class="navbar navbar-expand-md ">
					<div class="container-fluid d-flex justify-content-between">
						<?php
							if (has_custom_logo()){
								the_custom_logo();
							}else{ ?>
								<h1 class="site-title w-50">
									<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo('name');?></a>
								</h1>
						<?php } ?>

						<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						
						<div class="collapse navbar-collapse w-100 justify-content-end" id="main-menu">
							<?php
							wp_nav_menu(array(
								'theme_location' => 'main-menu',
								'container' => false,
								'menu_class' => 'nav-menu',
								'fallback_cb' => '__return_false',
								'items_wrap' => '<ul id="%1$s" class="navbar-nav mb-2 mb-md-0 %2$s">%3$s</ul>',
								'depth' => 3,
								'a_class' => 'dropdown-item',
								'walker' => new bootstrap_5_wp_nav_menu_walker()
							));
							?>
						</div>
					</div>
				</nav>
			</div> <!-- end col -->

				
				
				
			</div> <!-- end row -->
		</div> <!-- end container -->
	</header>









	

	<div id="main" class="wrapper">
