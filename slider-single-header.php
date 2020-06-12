<?php if (has_post_thumbnail(  $post->ID )){
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
         }else{
            $image = 'https://roam.qodeinteractive.com/wp-content/uploads/2017/08/destitnation-title-img-6.jpg';
         }?>

<div class="fovea-title-single mkdf-title-holder mkdf-standard-type mkdf-has-bg-image mkdf-bg-parallax" style="height: 550px; background-image: url(<?php
         

         echo $image[0]; ?>); background-position: center -40.81px;" data-height="550">
    <div class="mkdf-title-image">
    <?php
       
         if (has_post_thumbnail(  $post->ID )){
             echo' <img itemprop="image" src="';
             $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
         }
         echo $image[0].'" alt="m">'; ?>
    </div>
    <div class="mkdf-title-wrapper" style="height: 550px">
        <div class="mkdf-title-inner">
            <div class="mkdf-grid">
                <h1 class="mkdf-page-title entry-title" style="color: #ffffff"><?php single_post_title(); ?></h1>
            </div>
        </div>
    </div>
</div>