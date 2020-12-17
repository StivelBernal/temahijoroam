<div class="mkdf-grid-row">
    <div class="mkdf-grid-col-12 blog-fov-loop">

        <?php //echo do_shortcode('[serlib_buscador_home_input] '); ?>
        <div class=" row-wrap">


            <?php

            if (have_posts()) {

                while (have_posts()) {
                    the_post();

                    $busqueda_item = 0;

                    if(isset($_GET["busqueda"])){

                        $busqueda = [];
                        $busqueda = explode(' ', $_GET["busqueda"] );

                        if(isset($_GET["tags"]) && $_GET["tags"] !== ''){

                            $tags_busqueda = explode(',', $_GET["tags"]);

                            array_merge($busqueda, $tags_busqueda);

                        }

                        $post_src = $post->post_title.' '.$post->post_content.' '.$post->post_excerpt;

                        for($i = 0; $i < count($busqueda); $i++){

                            if(strripos($post_src, $busqueda[$i])){
                                $busqueda_item = 1;
                                $i = count($busqueda);
                            };

                        }
                        
                        if(isset($_GET["tags"]) && $_GET["tags"] !== ''){
                            
                            $tags = get_the_terms( $post->ID , 'post_tag' );
                        
                            if($tags){
                                                    
                                $busqueda_item = 0;
                                
                                for($i = 0; $i < count($tags); $i++ ) { 
                                    if(in_array($tags[$i]->slug, $tags_busqueda)){
                                        $busqueda_item = 1;
                                        $i = count($tags);
                                    }
                                }
                            
                            }
                        }

                        

                    
                    
                    }




            ?>
                    <?php if ((isset($_GET["busqueda"]) && $busqueda_item === 1) || !isset($_GET["busqueda"])) { ?>


                       
                            <?php

                            if (has_post_thumbnail()) {

                                $imagen_destacada = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'single-post-thumbnail')[0];
                            } else {

                                $imagen_destacada = 'https://golfodemorrosquillo.com/wp-content/uploads/2020/08/AZUL-OSCURO-con-logo-Horizontal.png';
                            }

                            $autor = get_userdata($post->post_author);

                            ?>
                            <article class="mkdf-post-has-media s-32">
                                <div class="mkdf-post-content">
                                    <div class="mkdf-post-heading">

                                        <div class="blog-fov-img mkdf-post-image">
                                            <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                <img src="<?php echo $imagen_destacada; ?>" > </a>
                                        </div>
                                    </div>
                                    <div class="mkdf-post-text">

                                        <div class="mkdf-post-text-inner">

                                            <h3 itemprop="name" class="entry-title mkdf-post-title">
                                                <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                <?php the_title(); ?> </a>
                                            </h3>
                                            <div class="detalles-post-blog">
                                                <span class="author"> <i class="fa fa-user" aria-hidden="true"></i><?php echo $autor->first_name.' '.$autor->last_name; ?> </span>
                                                <span class="fecha"> <i class="fa fa-calendar-check-o" aria-hidden="true"></i><?php echo  date_i18n( 'F j, Y', strtotime($post->post_date));  ?></span>
                                            </div>
                                          
                                        </div>
                                        
                                    </div>
                                </div>
                            </article>

            <?php
                    }
                }
            }

            ?>


        </div>
    </div>
</div>