<?php
$mkdf_blog_type = roam_mikado_get_archive_blog_list_layout();
roam_mikado_include_blog_helper_functions( 'lists', $mkdf_blog_type );
$mkdf_holder_params = roam_mikado_get_holder_params_blog();

get_header();

$opts = get_option( 'serlib' );

if ($opts['url_image_blog'] !== ''){
	$image = $opts['url_image_blog'];
}else{
   $image = '/wp-content/plugins/ser_lib/assets/img/blog-default.jpg';
}

?>

<div class="fovea-title-single s-featured-header mkdf-title-holder mkdf-standard-type  mkdf-bg-parallax" 
	style=" background-image: url(<?php echo $image; ?>); background-position: center -40.81px;" >
	<div class="mkdf-title-wrapper" >
		<div class="mkdf-title-inner">
		<div class="mkdf-grid">
			<h1 class="mkdf-page-title entry-title" style="color: #ffffff; text-shadow:1px 1px 2px #000000a6;"><?php echo __('Blog', 'serlib'); ?> </h1>
		</div>
		</div>
	</div>
</div>


<div class="<?php echo esc_attr( $mkdf_holder_params['holder'] ); ?>">
	<?php do_action( 'roam_mikado_after_container_open' ); ?>
	
	<div class="<?php echo esc_attr( $mkdf_holder_params['inner'] ); ?>">
		<?php  get_template_part( 'templates-fovea/categoria_blog' ); 
		//roam_mikado_get_blog( $mkdf_blog_type ); ?> 
	</div>
	
	<?php do_action( 'roam_mikado_before_container_close' ); ?>
</div>

<?php do_action( 'roam_mikado_blog_list_additional_tags' ); ?>
<?php get_footer(); ?>