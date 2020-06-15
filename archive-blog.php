<?php
$mkdf_blog_type = roam_mikado_get_archive_blog_list_layout();
roam_mikado_include_blog_helper_functions( 'lists', $mkdf_blog_type );
$mkdf_holder_params = roam_mikado_get_holder_params_blog();

get_header();
//roam_mikado_get_title();
//$opts = get_option( 'serlib' );
if (has_post_thumbnail(  $post->ID )){
	$image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
}else{
   $image = 'https://roam.qodeinteractive.com/wp-content/uploads/2017/08/destitnation-title-img-6.jpg';
}
?>

<div class="fovea-title-single mkdf-title-holder mkdf-standard-type mkdf-has-bg-image mkdf-bg-parallax" 
	style="height: 550px; background-image: url(<?php echo $image[0]; ?>); background-position: center -40.81px;" data-height="550">
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
			<h1 class="mkdf-page-title entry-title" style="color: #ffffff"><?php echo __('Blog', 'serlib'); ?> </h1>
		</div>
		</div>
	</div>
</div>


<div class="<?php echo esc_attr( $mkdf_holder_params['holder'] ); ?>">
	<?php do_action( 'roam_mikado_after_container_open' ); ?>
	
	<div class="<?php echo esc_attr( $mkdf_holder_params['inner'] ); ?>">
		<?php roam_mikado_get_blog( $mkdf_blog_type ); ?> FDG
	</div>
	
	<?php do_action( 'roam_mikado_before_container_close' ); ?>
</div>

<?php do_action( 'roam_mikado_blog_list_additional_tags' ); ?>
<?php get_footer(); ?>