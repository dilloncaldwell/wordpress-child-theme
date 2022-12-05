<?php get_header(); ?>

<section class="carousel-wrapper">
    
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
      <!-- Indicators -->
      <div class="carousel-indicators">
        <button id="slide-indicator" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
        <button id="slide-indicator" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button id="slide-indicator" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
    
      <!-- Wrapper for slides -->
      <div class="carousel-inner" role="listbox">
        <div class="carousel-caption">
            <h3>Static Headline And Content</h3>
            <p>Nulla vitae elit libero, a pharetra augue mollis interdum.</p>
            <div class="action-btns ">
                <button class="main-cta">Main CTA Btn</button>
                <button class="sec-cta">Secondary CTA Btn</button>
                </div>
        </div>
        <?php $slider = get_posts(array('post_type' => 'slider', 'posts_per_page' => 5, 'order' => 'ASC')); ?>
          <?php $count = 0; ?>
          <?php foreach($slider as $slide): ?>
          <div class="carousel-item <?php echo ($count == 0) ? 'active' : ''; ?>">
            <img src="<?php echo wp_get_attachment_url( get_post_thumbnail_id($slide->ID)) ?>" class="slider-img img-responsive d-block w-100"/>
          </div>
          <?php $count++; ?>
        <?php endforeach; ?>
        
      </div>
    
      <!-- Controls -->
      <button id="slider-control-btn" class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button id="slider-control-btn" class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
</section>

<section class="page-wrapper">
    <div class="container">
    
        <div class="row">
    
    
        </div>
        <?php get_template_part( 'includes/section', 'content' ); ?>
    
    </div>
</section>

<?php get_footer(); ?>