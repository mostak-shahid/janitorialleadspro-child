<?php
function add_slug_body_class( $classes ) {
    global $post;
    if ( isset( $post ) AND $post->post_type == 'page' ) {
        $classes[] = $post->post_type . '-' . $post->post_name;
    } else {
        $classes[] = $post->post_type . '-archive';
    }
    return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

add_action('astra_primary_content_bottom','mos_author_details_func');
function mos_author_details_func(){
    ?>
    Author Meta will come here
    <?php
}
add_action('astra_primary_content_bottom','mos_related_posts_func');
function mos_related_posts_func(){
    if(is_single()){
        $term_ids = [];
        $categories = get_the_category(get_the_ID());
        foreach($categories as $category){
            $term_ids[] = $category->term_id;
        }
        //var_dump(implode(',',$term_ids));
        $args = array(
            'posts_per_page' => 6,
            'cat' => implode(',',$term_ids),
            'post__not_in' => array(get_the_ID())
        );
        // The Query
        $the_query = new WP_Query( $args );

        // The Loop
        if ( $the_query->have_posts() ) : ?>
        <div class="related-post">
            <h2 class="section-title"><?php echo __('Related Posts') ?></h2>
            
            <div class="related-post-wrapper">
                <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

                    <div class="post-content">
                        <?php if (has_post_thumbnail()) : ?>
                            <div class="ast-blog-featured-section post-thumb">
                                <div class="post-thumb-img-content post-thumb"><a href="<?php echo get_the_permalink() ?>"><img width="373" height="210" src="<?php echo aq_resize(get_the_post_thumbnail_url('','full'), 373, 210, true) ?>" class="attachment-373x250 size-373x250 wp-post-image" alt="office cleaning safety tips - janitorial leads pro" loading="lazy" itemprop="image"></a></div>
                            </div>
                        <?php endif;?>
                        <div class="related-entry-header">
                            <h4 class="related-entry-title" itemprop="headline"><a href="<?php echo get_the_permalink() ?>" rel="bookmark"><?php echo get_the_title() ?></a></h4>
                        </div>
                    </div>       
               
                <?php endwhile; ?>
            </div>
        </div>
        <?php endif;
        /* Restore original Post Data */
        wp_reset_postdata();        
    }
}
add_action('astra_header_before','custom_sticky_header');
function custom_sticky_header(){
    ?>
    <div class="main-header-bar-wrap mos-sticky-header">
        <div <?php echo astra_attr( 'main-header-bar' ); ?>>
            <div class="ast-container">
                <div class="ast-flex main-header-container">
                    <?php astra_masthead_content(); ?>
                </div><!-- Main Header Container -->
            </div><!-- ast-row -->
            <?php astra_main_header_bar_bottom(); ?>
        </div> <!-- Main Header Bar -->
    </div> <!-- Main Header Bar Wrap -->
    <?php
}
add_action('astra_main_header_bar_top', 'mos_astra_header_before', 5);
function mos_astra_header_before(){
    ?>
    <div class="main-top-bar">
        <div class="ast-container">
            <div class="ast-flex main-top-bar-container">
                <div class="column one">
                    <ul class="contact_details">
                        <li class="slogan">Need Janitorial Leads?</li>
                        <li class="phone"><i class="fa fa-phone"></i> <a href="tel:(646)583-1385">(646) 583-1385</a></li>
                    </ul>                    
                </div>
            </div>
        </div>
    </div>
    <?php
}
add_action('astra_content_top','mos_custom_header');
function mos_custom_header(){
    if (is_home()) :
        $page_for_posts = get_option( 'page_for_posts' );
    ?>       
        <header class="entry-header ast-no-thumbnail ast-no-meta"><h1 class="entry-title" itemprop="headline"><?php echo get_the_title($page_for_posts) ?></h1></header>    
    <?php
    elseif (is_shop()) :
        $page_for_products = get_option( 'woocommerce_shop_page_id' );
    ?>       
        <header class="entry-header ast-no-thumbnail ast-no-meta"><h1 class="entry-title" itemprop="headline"><?php echo get_the_title($page_for_products) ?></h1></header>    
    <?php
    elseif ( is_single() && 'product' == get_post_type() ) :
    ?>       
        <header class="entry-header ast-no-thumbnail ast-no-meta"><h1 class="entry-title" itemprop="headline"><?php echo get_the_title(get_the_ID()) ?></h1></header>    
    <?php
    endif;
}
/**
 * Update the featured images size from Astra
 */
add_filter( 'astra_post_thumbnail_default_size', 'update_featured_images_size_callback' ); 
function update_featured_images_size_callback( $size ) {
    if(!is_single()) $size = array( 373, 250 ); // Update the 500(Width), 500(Height) as per your requirment.
	return $size;
}
if ( ! function_exists( 'mos_post_class_blog_grid' ) ) {
	function mos_post_class_blog_grid( $classes ) {

		if ( is_archive() || is_home() || is_search() ) {
			$classes[] = 'ast-col-md-4';
		}

		return $classes;
	}
}

add_filter( 'post_class', 'mos_post_class_blog_grid' );

// Update your custom tablet breakpoint below - like return 992;
add_filter( 'astra_tablet_breakpoint', function() {
    return 992;
});
// Update your custom mobile breakpoint below - like return 768px;
add_filter( 'astra_mobile_breakpoint', function() {
    return 768;
});