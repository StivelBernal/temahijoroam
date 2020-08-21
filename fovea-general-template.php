<?php

$metas = new class{};

$metas->mapa_negocio = get_post_meta($post->ID , 'mapa_negocio')[0];

$metas->telefono = get_post_meta($post->ID , 'telefono_negocio')[0];  
$metas->whatsapp = get_post_meta($post->ID , 'whatsapp_negocio')[0];  
$metas->facebook = get_post_meta($post->ID , 'facebook_negocio')[0];  
$metas->web = get_post_meta($post->ID , 'web_negocio')[0];  
$metas->correo = get_post_meta($post->ID , 'correo_negocio')[0];  
$metas->direccion = get_post_meta($post->ID , 'direccion_negocio')[0]; 
$metas->instagram = get_post_meta($post->ID , 'instagram_negocio')[0];  

// CAPTURAR EL ID Y MOSTRAR UNA VISUAL DEPENDIEDO DEL ID
if (have_posts()) : while (have_posts()) : the_post();
        //Get blog single type and load proper helper
        roam_mikado_include_blog_helper_functions('singles', 'standard');

        //Action added for applying module specific filters that couldn't be applied on init
        do_action('roam_mikado_blog_single_loaded');

        //Get classes for holder and holder inner
        $mkdf_holder_params = roam_mikado_get_holder_params_blog();
        echo '
         <div class="s-featured-header" style="background-image: url('.get_the_post_thumbnail_url(get_the_ID(),'full').')"></div>
        ';
?>
       
        <div class="fovea-comercio-single" ng-app="comercio_page" ng-controller="pageController">

            <div class="fovea-nav-holder">

                <div class="mkdf-grid row-wrap">
                   
                        <div class="s-flex comercio-tabs" ng-class="{'active-item': tab === 1  }" ng-click="tab = 1">
                            <span class="mkdf-tour-nav-section-icon dripicons-document"></span>
                            <span class="mkdf-tour-nav-section-title">
                            <?php echo _x('Publicación', 'nav menu single page comercio', 'roam-child');  ?> </span>
                        </div>
                      
                        <div class="s-flex comercio-tabs" ng-class="{'active-item': tab === 2 }" ng-click="tab = 2">
                            <span class="mkdf-tour-nav-section-icon dripicons-location"></span>
                            <span class="mkdf-tour-nav-section-title">
                            <?php echo _x('Ubicación', 'nav menu single page comercio', 'roam-child');  ?> </span>
                        </div>
                    
                        <div class="s-flex comercio-tabs" ng-class="{'active-item': tab === 3 }" ng-click="tab = 3">
                            <span class="mkdf-tour-nav-section-icon dripicons-camera"></span>
                            <span class="mkdf-tour-nav-section-title">
                            <?php echo _x('Comentarios', 'nav menu single page comercio', 'roam-child');  ?> </span>
                        </div>
                     
                       
                    </ul>

                </div>

            </div>

            <div class="mkdf-container">
                <div class="fovea-container-inner mkdf-container-inner">
                <div class="share-comercio">
                    <?php do_shortcode('[ser_like_share]'); ?>
                </div>
                
                    <!--Title redes sociales a la izquierda-->
                    <div class="title-and-socials">
                        <h1><?php single_post_title(); ?></h1>
                         <?php 
                            $whatsapp = str_replace(['+', ' ', '-', '.'], '', $metas->whatsapp );
                            echo '<p><strong>'.__('Dirección:').'</strong> '.$metas->direccion.'</p>
                        <div class="row start-center icons-comercio">
                           
                            <a href="'.$metas->facebook.'" target="blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                            <a href="https://wa.me/'.$whatsapp.'" target="blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                            <a href="'.$metas->instagram.'" target="blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="tel:'.$metas->telefono.'" ><i class="fa fa-phone-square" aria-hidden="true"></i></a>
                            <a href="mailto:'.$metas->correo.'" ><i class="fa fa-envelope-open-o " aria-hidden="true"></i></a>
                            <a href="'.$metas->web.'" target="blank"><i class="fa fa-external-link-square " aria-hidden="true"></i></a>
                           
                        </div>  '; ?>
                    </div>

                    <div class="clearfix mkdf-grid-medium-gutter">
                        <div class="mkdf-grid-col-9">
                            <article ng-hide="tab !== 1" class="mkdf-tour-item-wrapper">
                               <div class="fovea-content-comercio">
                                   <?php  the_content(); ?>
                                <div>

                            </article>
                      

                            <article ng-hide="tab !== 2"class="mkdf-tour-item-wrapper">
                            

                                <div  class="fovea-content-ubicacion">
                                    
                                    <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $metas->mapa_negocio; ?>&t=&z=9&ie=UTF8&iwloc=&output=embed"  frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>           
  
                                <div>

                            </article>

                            <article ng-hide="tab !== 3"class="mkdf-tour-item-wrapper">
                                <div  class="fovea-content-comentarios">
                                      <?php if (comments_open()){
                                            comments_template();
                                        }
                                ?>
                                <div>
                            </article>
                        </div>

                        <div class="mkdf-grid-col-3">
                            <?php get_sidebar(); ?>
                        </div>

                    </div>
                </div> 
            </div> 

        </div>
<?php endwhile;
endif;
