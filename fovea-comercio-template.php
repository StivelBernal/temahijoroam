<?php
//roam_mikado_get_title();
get_template_part('slider-single-header');
// CAPTURAR EL ID Y MOSTRAR UNA VISUAL DEPENDIEDO DEL ID
if (have_posts()) : while (have_posts()) : the_post();
        //Get blog single type and load proper helper
        roam_mikado_include_blog_helper_functions('singles', 'standard');

        //Action added for applying module specific filters that couldn't be applied on init
        do_action('roam_mikado_blog_single_loaded');

        //Get classes for holder and holder inner
        $mkdf_holder_params = roam_mikado_get_holder_params_blog();

        /**Get user meta mapa, galeria, comentarios, servicios */

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
                    <div class="clearfix mkdf-grid-medium-gutter">
                        <div class="mkdf-grid-col-9">
                            <article ng-hide="tab !== 1" class="mkdf-tour-item-wrapper">
                               <div class="fovea-content-comercio">
                                   <?php  the_content(); ?>
                                <div>

                            </article>
                            <article ng-hide="tab !== 2"class="mkdf-tour-item-wrapper">
                            
                                <div class="fovea-content-servicios">
                                    SERVICIOS
                                <div>

                            </article>

                            <article ng-hide="tab !== 3"class="mkdf-tour-item-wrapper">
                            

                                <div  class="fovea-content-ubicacion">
                                    UBICACION
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
