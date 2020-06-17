<!--AQUI SOLUCIONAR EL CONTENIDO QUE SE MEUSTRE SEA DEL MUNICIPIO-->
<?php

$mkdf_blog_type = roam_mikado_get_archive_blog_list_layout();
roam_mikado_include_blog_helper_functions( 'lists', $mkdf_blog_type );
$mkdf_holder_params = roam_mikado_get_holder_params_blog();

get_header();

/**Hacer un sistema de rutas como el que hacia en php */
$rutas = explode('/' ,$_SERVER['REQUEST_URI']);
$tipo_entrada = get_term_by('slug', $rutas[2], 'tipos_entradas' );
$municipio = get_term_by('slug', $rutas[1], 'category' );
$catfull = '';

if(isset($rutas[2]) && $tipo_entrada ){

	$titulo = $municipio->name.': <span>'.$tipo_entrada->name.'</span>';

	$catdesign2 = ['restaurantes']; 
	$catdesign3 = ['sitios', 'emergencias']; 
	$catdesign4 = ['diversion']; 
	
	if(in_array($rutas[2], $catdesign2)){
		$catopt = 2;
	}else if(in_array($rutas[2], $catdesign3)){
		$catfull = 'cat-full';
		$catopt = 3;

	}else if(in_array($rutas[2], $catdesign4)){
		
		$catopt = 4;

	}else{
		$catopt = 1;
	}

/** Si no se encuentra el termino regresa a la pagina del munipio o post-type page */
}else{
	$titulo =  $municipio->name;
	$catopt = 1;
/**Cerramos comparacion si es municipio o si es una categoria interna */
} 

?>
<div class="mkdf-title-holder mkdf-standard-type" style="height: 300px" data-height="300">
	<div class="mkdf-title-wrapper" style="height: 300px">
		<div class="mkdf-title-inner">
			<div class="mkdf-grid">
				<h1 class="mkdf-page-title entry-title"><?php echo $titulo ?></h1>
				
			</div>
		</div>
	</div>
</div>


<div class=" <?php echo $catfull.' '. esc_attr( $mkdf_holder_params['holder'] ); ?>">
	<?php do_action( 'roam_mikado_after_container_open' ); ?>
	
	<div class="<?php echo esc_attr( $mkdf_holder_params['inner'] ); ?>">
		<?php 
		if($catopt === 1){
			get_template_part( 'templates-fovea/categoria' );
			//get_template_part( 'templates-fovea/categoria-diversion' );
			//get_template_part( 'templates-fovea/categoria-sitios' );
		}else if($catopt === 2){
			get_template_part( 'templates-fovea/categoria-reveal' );
		}else if($catopt === 3){
			get_template_part( 'templates-fovea/categoria-sitios' );
		}else if($catopt === 4){
			get_template_part( 'templates-fovea/categoria-diversion' );
		}
		else{
			get_template_part( 'templates-fovea/categoria' );
		}
		
		
		?>
	</div>
	
	<?php do_action( 'roam_mikado_before_container_close' ); ?>
</div>

<?php 
do_action( 'roam_mikado_blog_list_additional_tags' ); 

get_footer(); 
?>