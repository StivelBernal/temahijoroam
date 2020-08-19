<?php

get_header();
//roam_mikado_get_title();


// CAPTURAR EL ID Y MOSTRAR UNA VISUAL DEPENDIEDO DEL ID
if (have_posts()) : while (have_posts()) : the_post();
        //Get blog single type and load proper helper
        roam_mikado_include_blog_helper_functions('singles', 'standard');

        //Action added for applying module specific filters that couldn't be applied on init
        do_action('roam_mikado_blog_single_loaded');

        //Get classes for holder and holder inner
        $mkdf_holder_params = roam_mikado_get_holder_params_blog();
        echo '
         <div class="s-featured-header" style="background-image: url('.get_the_post_thumbnail_url().')"></div>
        ';
?>
       
        <div class="f-blog-single" >

            <div class="mkdf-container">
                <div class="fovea-container-inner mkdf-container-inner">
                    <!--Title redes sociales a la izquierda-->
                    <div class="title-and-socials">
                        <h1><?php single_post_title(); ?></h1>
                    </div>

                    <div class="clearfix mkdf-grid-medium-gutter">
                        <div class="mkdf-grid-col-9">
                            <article class="mkdf-tour-item-wrapper">
                               <div class="fovea-content-comercio">
                                   <?php  the_content(); ?>
                                <div>

                            </article>
                      
                        </div>

                        <div class="mkdf-grid-col-3">
                            <?php get_sidebar(); ?>
                        </div>

					</div>
					<div class="s-100">

						<div class="mkdf-tour-item-wrapper">
                                <div  class="fovea-content-comentarios">
                                      <?php if (comments_open()){
                                            comments_template();
                                        }
                                ?>
                                <div>
						</div>
					</div>
                </div> 
            </div> 

        </div>
<?php endwhile;
endif;



do_shortcode('[ser_like_share]');
get_footer(); ?>