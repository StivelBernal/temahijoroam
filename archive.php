<!--AQUI SOLUCIONAR EL CONTENIDO QUE SE MEUSTRE SEA DEL MUNICIPIO-->
<?php


/**Hacer un sistema de rutas como el que hacia en php */
$rutas = explode('/' ,$_SERVER['REQUEST_URI']);

if(isset($rutas[2])){

	echo 'pagina categoria municipio '.$rutas[2];
	var_dump(get_term_by('slug', $rutas[2], 'tipos_entradas') );
}else{
	echo 'pagina municipio '.$rutas[1];
}
$mkdf_blog_type = roam_mikado_get_archive_blog_list_layout();
roam_mikado_include_blog_helper_functions( 'lists', $mkdf_blog_type );
$mkdf_holder_params = roam_mikado_get_holder_params_blog();

get_header();
roam_mikado_get_title();
?>

<div class="<?php echo esc_attr( $mkdf_holder_params['holder'] ); ?>">
	<?php do_action( 'roam_mikado_after_container_open' ); ?>
	
	<div class="<?php echo esc_attr( $mkdf_holder_params['inner'] ); ?>">
		<?php get_template_part( 'templates-fovea/municipio' );?>
	</div>
	
	<?php do_action( 'roam_mikado_before_container_close' ); ?>
</div>

<?php do_action( 'roam_mikado_blog_list_additional_tags' ); ?>
<?php get_footer(); ?>