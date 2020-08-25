<?php

$metas = new class{} ;

$metas->mapa_negocio = get_post_meta($post->ID , 'mapa_negocio')[0];

$metas->galery_ids = get_post_meta($post->ID , 'galeria_negocio')[0];

$metas->galery = [];

for($i = 0; $i < count($metas->galery_ids); $i++ ) { 
    $metas->galery[$i] = wp_get_attachment_image_src($metas->galery_ids[$i])[0];
}

$metas->servicios = get_post_meta($post->ID , 'servicios_negocio')[0];  


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

        /**Get user meta mapa, galeria, comentarios, servicios */


      
        $itemsCarrusel = '';
      
    foreach ($metas->galery as $key => $value) {
                               
                $itemsCarrusel .= '
                <div class="swiper-slide " >
                    <img src="'.$value.'">
                </div>';
        
            }
    
    echo ' 
                <div class="carrusel-galery-comercio">
                    <div class="swiper-container-comercio">
                        <div class="swiper-wrapper">
                          '.$itemsCarrusel.'  
                        </div>
                    </div>
                </div>';

?>
        <div class="fovea-comercio-single" ng-app="comercio_page" ng-controller="pageController">

            <div class="fovea-nav-holder">

                <div class="mkdf-grid row-wrap">
                   
                        <div class="s-flex comercio-tabs" ng-class="{'active-item': tab === 1  }" ng-click="tab = 1">
                            <span class="mkdf-tour-nav-section-icon dripicons-document"></span>
                            <span class="mkdf-tour-nav-section-title">
                                <?php echo _x('Información', 'nav menu single page comercio', 'roam-child');  ?> </span>
                        </div>

                        <div class="s-flex comercio-tabs" ng-class="{'active-item': tab === 2 }" ng-click="tab = 2">
                            <span class="mkdf-tour-nav-section-icon dripicons-map"></span>
                            <span class="mkdf-tour-nav-section-title">
                            <?php echo _x('Servicios', 'nav menu single page comercio', 'roam-child');  ?> </span>
                        </div>
                      
                        <div class="s-flex comercio-tabs" ng-class="{'active-item': tab === 3 }" ng-click="tab = 3">
                            <span class="mkdf-tour-nav-section-icon dripicons-location"></span>
                            <span class="mkdf-tour-nav-section-title">
                            <?php echo _x('Ubicación', 'nav menu single page comercio', 'roam-child');  ?> </span>
                        </div>
                    
                        <div class="s-flex comercio-tabs" ng-class="{'active-item': tab === 4 }" ng-click="tab = 4">
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
                        <em style="text-align: text-center;"><?php the_excerpt() ?></em>
                         <?php 
                            $whatsapp = str_replace(['+', ' ', '-', '.'], '', $metas->whatsapp );
                            echo '<p><strong>'.__('Dirección:').'</strong> '.$metas->direccion.'</p>
                        <div class="row start-center icons-comercio">
                           
                            <a href="'.$metas->facebook.'" target="blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a>
                            <a href="https://wa.me/'.$whatsapp.'" target="blank"><i class="fa fa-whatsapp" aria-hidden="true"></i></a>
                            <a href="'.$metas->instagram.'" target="blank"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                            <a href="tel:'.$metas->telefono.'"><i class="fa fa-phone-square" aria-hidden="true"></i></a>
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
                             
                                <div class="fovea-content-servicios row-wrap space-between-center">
                                <?php

                                    for($i = 0; $i < count($metas->servicios); $i++){
                                        
                                        echo '<div class="s-43  ">

                                                <div class="viñeta"><i class="fa fa-circle" aria-hidden="true"></i>
                                                <h3 class="name_service">'.$metas->servicios[$i]->title .'</h3>
                                                    <div class="column">
                                                    
                                                    <p class="text_service">'.$metas->servicios[$i]->text .'</p>
                                                        <span class="price_service">'.$metas->servicios[$i]->price .'</span>
                                                    </div>
                                                </div>
                                        
                                            </div>';                                
                                
                                    }  
                                
                                ?>
                                <div>

                            </article>

                            <article ng-hide="tab !== 3"class="mkdf-tour-item-wrapper">
                            

                                <div  class="fovea-content-ubicacion">
                                    
                                    <iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $metas->mapa_negocio; ?>&t=&z=9&ie=UTF8&iwloc=&output=embed"  frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>           
  
                                <div>

                            </article>

                            <article ng-hide="tab !== 4"class="mkdf-tour-item-wrapper">
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
