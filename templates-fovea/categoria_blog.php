<div class="mkdf-grid-row">
    <div class="mkdf-grid-col-12 blog-fov-loop">

        <?php //echo do_shortcode('[serlib_buscador_home_input] '); ?>
        <div class=" row-wrap">


            <?php

            if (have_posts()) {

                while (have_posts()) {
                    the_post();

                    $busqueda_item = 0;

                    if (isset($_GET["busqueda"])) {
                        $busqueda = explode(' ', $_GET["busqueda"]);
                        $titulo = get_the_title($post->ID);

                        for ($i = 0; $i < count($busqueda); $i++) {

                            if (stripos($titulo, $busqueda[$i])) {
                                $busqueda_item = 1;
                            };
                        }
                        if (isset($_GET["tags"])) {
                            $tags = get_the_terms($post->ID, 'post_tag');
                            if ($tags) {

                                $tags_busqueda = explode(',', $_GET["tags"]);

                                for ($i = 0; $i < count($tags); $i++) {
                                    if (in_array($tags[0]->slug, $tags_busqueda)) {
                                        $busqueda_item = 1;
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

                                $imagen_destacada = '/wp-content/plugins/ser_lib/assets/img/images.png';
                            }

                            ?>
                            <article class="mkdf-post-has-media s-32">
                                <div class="mkdf-post-content">
                                    <div class="mkdf-post-heading">

                                        <div class="blog-fov-img mkdf-post-image">
                                            <a itemprop="url" href="<?php the_permalink(); ?>" title="gfhhgf">
                                                <img src="<?php echo $imagen_destacada; ?>" > </a>
                                        </div>
                                    </div>
                                    <div class="mkdf-post-text">

                                        <div class="mkdf-post-text-inner">

                                            <h3 itemprop="name" class="entry-title mkdf-post-title">
                                                <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                                                <?php the_title(); ?> </a>
                                            </h3>
                                              <!--<div class="mkdf-post-text-main">
                                                  <p itemprop="description" class="mkdf-post-excerpt">
                                                <div class="mkdf-post-excerpt-holder">
                                                     </p>
                                                </div>
                                            </div>-->
                                          
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