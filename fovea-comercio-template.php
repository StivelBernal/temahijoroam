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
?>

        <div class="fovea-comercio-single">

            <div class="fovea-nav-holder">

                <div class="mkdf-grid row-wrap">
                   
                        <div class="s-flex comercio-tabs" ng-click="tab === 1">
                            <span class="mkdf-tour-nav-section-icon dripicons-document"></span>
                            <span class="mkdf-tour-nav-section-title">
                                <?php echo _x('Información', 'nav menu single page comercio', 'roam-child');  ?> </span>
                        </div>

                        <div class="s-flex comercio-tabs" ng-click="tab === 2">
                            <span class="mkdf-tour-nav-section-icon dripicons-map"></span>
                            <span class="mkdf-tour-nav-section-title">
                            <?php echo _x('Servicios', 'nav menu single page comercio', 'roam-child');  ?> </span>
                        </div>
                      
                        <div class="s-flex comercio-tabs" ng-click="tab === 3">
                            <span class="mkdf-tour-nav-section-icon dripicons-location"></span>
                            <span class="mkdf-tour-nav-section-title">
                            <?php echo _x('Ubicación', 'nav menu single page comercio', 'roam-child');  ?> </span>
                        </div>
                    
                        <div class="s-flex comercio-tabs" ng-click="tab === 4">
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
                            <article class="mkdf-tour-item-wrapper">
                                fdgfg
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
