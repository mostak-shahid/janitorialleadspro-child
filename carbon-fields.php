<?php
use Carbon_Fields\Block;
use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
    /*Container::make( 'theme_options', __( 'Theme Options', 'crb' ) )
        ->add_fields( array(
            Field::make( 'text', 'crb_text', 'Text Field' ),
        ));
    Container::make( 'post_meta', 'Custom Data' )
        ->where( 'post_type', '=', 'page' )
        ->add_fields( array(
            Field::make( 'map', 'crb_location' )
                ->set_position( 37.423156, -122.084917, 14 ),
            Field::make( 'sidebar', 'crb_custom_sidebar' ),
            Field::make( 'image', 'crb_photo' ),
        ));*/
    
    Container::make( 'theme_options', __( 'Custom Code', 'crb' ) )
        ->add_fields( array(
            Field::make( 'textarea', 'mos_additional_coding', 'Additional Coding' ),
        ));
    
    Block::make( __( 'Mos Media Block' ) )
        ->add_fields( array(
        Field::make( 'image', 'mos-media-image', __( 'Image' ) ),
        Field::make( 'text', 'mos-media-icon-class', __( 'Icon Class' ) ),
        Field::make( 'textarea', 'mos-media-svg', __( 'SVG Code' ) ),
        Field::make( 'text', 'mos-media-heading', __( 'Heading' ) ),
        Field::make( 'rich_text', 'mos-media-content', __( 'Content' ) ),
        Field::make( 'text', 'mos-media-btn-title', __( 'Button' ) ),
        Field::make( 'text', 'mos-media-btn-url', __( 'URL' ) ),
        Field::make( 'multiselect', 'mos-media-block-one', __( 'Block One' ) )
            ->set_options( array(
                'image' => 'Image',
                'icon' => 'Icon',
                'svg' => 'SVG',
                'heading' => 'Heading',
                'content' => 'Content',
                'button' => 'Button',
            ))
            ->set_default_value( ['image','icon','svg','heading','content','button'] ),
        Field::make( 'multiselect', 'mos-media-block-two', __( 'Block Two' ) )
            ->set_options( array(
                'image' => 'Image',
                'icon' => 'Icon',
                'svg' => 'SVG',
                'heading' => 'Heading',
                'content' => 'Content',
                'button' => 'Button',
            )),
        Field::make( 'select', 'mos-media-alignment', __( 'Content Alignment' ) )
            ->set_options( array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center',
            )),
    ))
    ->set_icon( 'id-alt' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-media-block-wrapper <?php echo (@$attributes['className'])?$attributes['className']:'' ?>">
            <div class="mos-media-block position-relative text-<?php echo esc_html( $fields['mos-media-alignment'] ) ?>">    
                <?php if (sizeof($fields['mos-media-block-one'])) : ?>
                <div class="part-one">  
                    <?php foreach($fields['mos-media-block-one'] as $part_1) : ?>
                        <?php if ($part_1 == 'image' && $fields['mos-media-image']) : ?>
                            <div class="img-part"><?php echo wp_get_attachment_image( $fields['mos-media-image'], 'full' ); ?></div>
                        <?php elseif ($part_1 == 'icon' && $fields['mos-media-icon-class']) : ?>
                            <span class="icon-part"><i class="<?php echo esc_html( $fields['mos-media-icon-class'] ); ?>"></i></span>
                        <?php elseif ($part_1 == 'svg' && $fields['mos-media-svg']) : ?>
                            <span class="svg-part"><?php echo $fields['mos-media-svg']; ?></span>
                        <?php elseif ($part_1 == 'heading' && $fields['mos-media-heading']) : ?>
                            <h4 class="title-part"><?php echo esc_html( $fields['mos-media-heading'] ); ?></h4>
                        <?php elseif ($part_1 == 'content' && $fields['mos-media-content']) :?>
                            <div class="desc"><?php echo apply_filters( 'the_content', $fields['mos-media-content'] ); ?></div> 
                        <?php elseif ($part_1 == 'button' && $fields['mos-media-btn-title'] && $fields['mos-media-btn-url']) :?>   
                            <div class="wp-block-buttons"><div class="wp-block-button"><span title="" class="wp-block-button__link"><?php echo do_shortcode( $fields['mos-media-btn-title'] ); ?></span></div></div> 
                        <?php endif;?>
                    <?php endforeach;?>              
                </div>
                <?php endif?>
                <?php if (sizeof($fields['mos-media-block-two'])) : ?>
                <div class="part-two">
                    <?php foreach($fields['mos-media-block-two'] as $part_2) : ?>
                        <?php if ($part_2 == 'image' && $fields['mos-media-image']) : ?>
                            <div class="img-part"><?php echo wp_get_attachment_image( $fields['mos-media-image'], 'full' ); ?></div>
                        <?php elseif ($part_2 == 'icon' && $fields['mos-media-icon-class']) : ?>
                            <span class="icon-part"><i class="<?php echo esc_html( $fields['mos-media-icon-class'] ); ?>"></i></span>
                        <?php elseif ($part_2 == 'svg' && $fields['mos-media-svg']) : ?>
                            <span class="svg-part"><?php echo $fields['mos-media-svg']; ?></span>
                        <?php elseif ($part_2 == 'heading' && $fields['mos-media-heading']) : ?>
                            <h4 class="title-part"><?php echo esc_html( $fields['mos-media-heading'] ); ?></h4>
                        <?php elseif ($part_2 == 'content' && $fields['mos-media-content']) :?>
                            <div class="desc"><?php echo apply_filters( 'the_content', $fields['mos-media-content'] ); ?></div> 
                        <?php elseif ($part_2 == 'button' && $fields['mos-media-btn-title'] && $fields['mos-media-btn-url']) :?>   
                            <div class="wp-block-buttons"><div class="wp-block-button"><span title="" class="wp-block-button__link"><?php echo do_shortcode( $fields['mos-media-btn-title'] ); ?></span></div></div> 
                        <?php endif;?>
                    <?php endforeach;?>               
                </div>
                <?php endif?>
                <?php if ($fields['mos-media-btn-url']) :?>
                    <a href="<?php echo esc_url( $fields['mos-media-btn-url'] ); ?>" class="hidden-link">Read more</a>
                <?php endif?>
            </div>
        </div>
        <?php
    });    
    
    Block::make( __( 'Mos Image Block' ) )
    ->add_fields( array(
        Field::make( 'text', 'mos-image-heading', __( 'Heading' ) ),
        Field::make( 'image', 'mos-image-media', __( 'Image' ) ),
        Field::make( 'rich_text', 'mos-image-content', __( 'Content' ) ),
        Field::make( 'color', 'mos-image-hr', __( 'Border Color' ) ),
        Field::make( 'select', 'mos-image-alignment', __( 'Content Alignment' ) )
            ->set_options( array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center',
            ))
    ))
    ->set_icon( 'id-alt' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-image-block-wrapper <?php echo $attributes['className'] ?>">
            <div class="mos-image-block text-<?php echo esc_html( $fields['mos-image-alignment'] ) ?> text-sm-center">
                <?php echo wp_get_attachment_image( $fields['mos-image-media'], 'full' ); ?>
                <h4><?php echo esc_html( $fields['mos-image-heading'] ); ?></h4>
                <hr style="background-color: <?php echo esc_html( $fields['mos-image-hr'] ) ?>;">
                <div class="desc"><?php echo apply_filters( 'the_content', $fields['mos-image-content'] ); ?></div>
            </div>
        </div>
        <?php
    });
    Block::make( __( 'Mos 3 Column CTA' ) )
    ->add_fields( array(
        Field::make( 'text', 'mos-3ccta-heading', __( 'Heading' ) ),        
        Field::make( 'image', 'mos-3ccta-media', __( 'Image' ) ),
        Field::make( 'text', 'mos-3ccta-link', __( 'Link' ) ),
        Field::make( 'text', 'mos-3ccta-link-2', __( 'Link 2' ) ),
        Field::make( 'textarea', 'mos-3ccta-content', __( 'Content' ) ),
        Field::make( 'image', 'mos-3ccta-bgimage', __( 'Background Image' ) ),
        Field::make( 'color', 'mos-3ccta-bgcolor', __( 'Background Color' ) ),
    ))
    ->set_icon( 'phone' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-3ccta-wrapper <?php echo $attributes['className'] ?>" style="<?php if ($fields['mos-3ccta-bgcolor']) echo 'background-color:'.esc_html($fields['mos-3ccta-bgcolor']).';' ?><?php if ($fields['mos-3ccta-bgimage']) echo 'background-image:url('.wp_get_attachment_url($fields['mos-3ccta-bgimage']).');' ?>">
            <div class="mos-3ccta">
                <div class="call-left">
                    <h3><a href="<?php echo ($fields['mos-3ccta-link-2'])?esc_url( $fields['mos-3ccta-link-2'] ):'#'; ?>"><?php echo esc_html( $fields['mos-3ccta-heading'] ); ?></a></h3>
                </div>
                <div class="call-center">
                    <a href="<?php echo esc_url( $fields['mos-3ccta-link'] ); ?>" class="" target="_blank"><?php echo wp_get_attachment_image( $fields['mos-3ccta-media'], 'full' ); ?></a>
                </div>
                <div class="call-right">
                    <div class="desc"><?php echo esc_html( $fields['mos-3ccta-content'] ); ?></div>
                </div>
            </div>
        </div>
        <?php
    });
    Block::make( __( 'Mos Icon Block' ) )
    ->add_fields( array(
        Field::make( 'text', 'mos-icon-heading', __( 'Heading' ) ),
        Field::make( 'text', 'mos-icon-class', __( 'Icon Class' ) ),
        Field::make( 'color', 'mos-icon-color', __( 'Color' ) ),
        Field::make( 'textarea', 'mos-icon-content', __( 'Content' ) ),
        Field::make( 'select', 'mos-icon-alignment', __( 'Content Alignment' ) )
            ->set_options( array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center',
            ))
    ))
    ->set_description( __( 'Use Font Awesome in <b>Icon class</b>, you can find Fontawesome <a href="https://fontawesome.com/v4.7.0/cheatsheet/">Here</a>.' ) )
    ->set_icon( 'editor-customchar' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-icon-block-wrapper <?php echo $attributes['className'] ?>">
            <div class="mos-icon-block text-<?php echo esc_html( $fields['mos-icon-alignment'] ) ?>">
                <i class="fa <?php echo esc_html( $fields['mos-icon-class'] ); ?>" style="--color:<?php echo esc_html( $fields['mos-icon-color'] ); ?>"></i>
                <h4><?php echo esc_html( $fields['mos-icon-heading'] ); ?></h4>
                <p><?php echo esc_html( $fields['mos-icon-content'] ); ?></p>
            </div>
        </div>
        <?php
    });
    Block::make( __( 'Mos Counter Block' ) )
    ->add_fields( array(
        Field::make( 'text', 'mos-counter-prefix', __( 'Prefix' ) ),
        Field::make( 'text', 'mos-counter-number', __( 'Number' ) ),
        Field::make( 'text', 'mos-counter-suffix', __( 'Suffix' ) ),
        Field::make( 'color', 'mos-counter-color', __( 'Heading Color' ) ),
        Field::make( 'color', 'mos-counter-border-color', __( 'Border Color' ) ),
        Field::make( 'textarea', 'mos-counter-content', __( 'Content' ) ),
        Field::make( 'select', 'mos-counter-alignment', __( 'Content Alignment' ) )
            ->set_options( array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center',
            ))
    ))
    ->set_icon( 'clock' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        ?>
        <div class="mos-counter-block-wrapper <?php echo $attributes['className'] ?>">
            <div class="mos-counter-block text-<?php echo esc_html( $fields['mos-counter-alignment'] ) ?>" style="border-color: <?php echo esc_html( $fields['mos-counter-border-color'] ); ?>">
                <h2 style="color: <?php echo esc_html( $fields['mos-counter-color'] ); ?>"><span class="prefix"><?php echo esc_html( $fields['mos-counter-prefix'] ); ?></span><span class='numscroller' data-min='1' data-max='<?php echo esc_html( $fields['mos-counter-number'] ); ?>' data-delay='5' data-increment='10'><?php echo esc_html( $fields['mos-counter-number'] ); ?></span><span class="suffix"><?php echo esc_html( $fields['mos-counter-suffix'] ); ?></span></h2>
                <p class="mb-0"><?php echo esc_html( $fields['mos-counter-content'] ); ?></p>
            </div>
        </div>
        <?php
    });
    
    Block::make( __( 'Mos Post Block' ) )
    ->add_fields( array(
        Field::make( 'text', 'mos-post-nop', __( 'No. of Posts' ) ),
        Field::make( 'text', 'mos-post-offset', __( 'Offset' ) ),
        Field::make( 'color', 'mos-post-color', __( 'Color' ) ),
        Field::make( 'select', 'mos-post-alignment', __( 'Content Alignment' ) )
            ->set_options( array(
                'left' => 'Left',
                'right' => 'Right',
                'center' => 'Center',
            ))
    ))
    ->set_icon( 'admin-post' )
    ->set_render_callback( function ( $fields, $attributes, $inner_blocks ) {
        $args = array(
            'post_type' => 'post',
            'posts_per_page' => ($fields['mos-post-nop'])?esc_html( $fields['mos-post-nop'] ):2,
        );
        if ($fields['mos-post-offset']) {
            $args['offset'] = esc_html( $fields['mos-post-offset'] );
        }
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) : ?>
            <div class="mos-post-block-wrapper <?php echo $attributes['className'] ?>">
            <?php while ( $query->have_posts() ) : $query->the_post(); ?>
                <div class="mos-post-block text-<?php echo esc_html( $fields['mos-post-alignment'] ) ?> text-sm-center">
                <?php if ( has_post_thumbnail() ) : ?>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                        <?php the_post_thumbnail('medium'); ?>
                    </a>
                <?php endif; ?>
                <div class="text-wrapper">                    
                    <h4 class="title"><a href="<?php the_permalink(); ?>"><?php echo get_the_title()?></a></h4>
                    <div class="desc">
                        <?php echo strip_tags(wp_trim_words( strip_shortcodes(get_the_content()), 10, '...' )); ?>
                        <?php //echo get_the_excerpt(); ?>
                    </div>
                    <div class="meta">
                        <?php 
                        $author_id = get_post_field ('post_author', get_the_ID());
                        $author_display_name = get_the_author_meta( 'display_name' , $author_id );
                        ?>
                        <div class="author-meta">By <a href="<?php echo get_author_posts_url($author_id)?>" title="View all posts by <?php echo $author_display_name?>" rel="author" class="url fn n" itemprop="url"><?php echo $author_display_name?></a></div>
                        <div class="date-meta"><?php echo get_the_date(); ?></div>
                    </div>
                </div>
                </div>
            <?php endwhile; ?>
            </div>
        <?php endif; ?>
        <?php wp_reset_postdata();
    });
}
add_action( 'after_setup_theme', 'crb_load' );
function crb_load() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();
}