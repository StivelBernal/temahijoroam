<div class="mkdf-grid-row">
    <div class="mkdf-grid-col-9">

        <?php echo do_shortcode( '[serlib_buscador_home_input] '); ?>
        <div class=" row-wrap">


<?php

if( have_posts() ){
    while( have_posts() ){
        the_post();
        ?>


       <div class="entry clearfix s-field hover-cat-1">
    <?php

            if( has_post_thumbnail() ){
               
                $imagen_destacada = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' )[0];

            }else{

                $imagen_destacada = 'https://roam.qodeinteractive.com/wp-content/uploads/2017/08/destitnation-title-img-6.jpg';

            }

            ?> 

            <div class="fovea-category-1">
                <div class="mkdf-tours-gallery-simple-item-image-holder">
                    <div class="mkdf-tours-gallery-simple-item-image">
                        <img src="<?php echo $imagen_destacada; ?>" class="attachment-full size-full wp-post-image" alt="<?php the_title(); ?> </a>">
                         
                        <div class="reveal-category-item">
                            <div class="mkdf-tours-gallery-simple-item-content-inner">
                                <h5 class="mkdf-tours-gallery-simple-item-destination-holder">
                                    <a class="mkdf-tour-item-destination" href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?> </a>
                                </h5>
                                <div class="mkdf-tours-gallery-simple-title-holder">
                                    <p class="excerpt-category-item">
                                    <?php the_category(); ?>   </p>
                                </div>
                            </div>
                        </div>
                        <a class="link-item-category-image" href="<?php the_permalink(); ?>"></a>
                    </div> 
                   
                </div>
            </div>

           
        </div>
      
      
        <?php
    }
}

?>





        </div>
    </div>
    <div class="mkdf-grid-col-3">
         <?php get_sidebar(); ?>
    </div>
</div>