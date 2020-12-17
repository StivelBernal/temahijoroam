<div class="mkdf-grid-row">
    <div class="mkdf-grid-col-12">
        
        <?php //echo do_shortcode( '[serlib_buscador_home_input] '); ?>

        <div class=" row-wrap">


<?php

if( have_posts() ){
    
    while( have_posts() ){
        the_post();

        $busqueda_item = 0;

        if(isset($_GET["busqueda"])){

            $busqueda = $_GET["busqueda"].' '.$_GET["tags"];
            
            $busqueda_item = 1;

            $post_src = $post->post_title.' '.$post->post_content.' '.$post->post_excerpt;
            
            for($i = 0; $i < count($busqueda); $i++){

                
                if(stripos($post_src, $busqueda[$i])){
                    $busqueda_item = 1;
                };

            }

            if(isset($_GET["tags"]) && $_GET["tags"] !== ''){
            
                $tags = get_the_terms( $post->ID , 'post_tag' );
            
                if($tags){
                    
                    $tags_busqueda = explode(',', $_GET["tags"]);
                    
                    $busqueda_item = 0;
                    
                    for($i = 0; $i < count($tags); $i++ ) { 
                        if(in_array($tags[$i]->slug, $tags_busqueda)){
                            $busqueda_item = 1;
                        }
                    }
                   
                }
            }
           
        }

        ?>
        <?php if( (isset($_GET["busqueda"]) && $busqueda_item === 1) || !isset($_GET["busqueda"]) ){ ?>

       <div class="entry clearfix s-field hover-cat-1">
           
           <?php

               
                if (has_post_thumbnail()) {

                    $imagen_destacada = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail')[0];
                } else {

                    $imagen_destacada = 'https://golfodemorrosquillo.com/wp-content/uploads/2020/08/AZUL-OSCURO-con-logo-Horizontal.png';
                }

            ?> 

            <div class="fovea-category-1">
                <div class="mkdf-tours-gallery-simple-item-image-holder">
                    <div class="mkdf-tours-gallery-simple-item-image">
                        <img src="<?php echo $imagen_destacada; ?>" class="attachment-full size-full wp-post-image" alt="<?php the_title(); ?> </a>">
                         
                        <div class="reveal-category-item">
                            <div class="mkdf-tours-gallery-simple-item-content-inner">
                                <h3 class="mkdf-tours-gallery-simple-item-destination-holder">
                                    <a class="mkdf-tour-item-destination" href="<?php the_permalink(); ?>">
                                    <?php the_title(); ?> </a>
                                </h3>
                               
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
}

?>





        </div>
    </div>
   
</div>