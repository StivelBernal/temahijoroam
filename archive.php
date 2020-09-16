<!--AQUI SOLUCIONAR EL CONTENIDO QUE SE MEUSTRE SEA DEL MUNICIPIO-->
<?php

$mkdf_blog_type = roam_mikado_get_archive_blog_list_layout();
roam_mikado_include_blog_helper_functions( 'lists', $mkdf_blog_type );
$mkdf_holder_params = roam_mikado_get_holder_params_blog();

get_header();

/**Hacer un sistema de rutas como el que hacia en php */
if(isset($_GET["busqueda"])){
	$rutas = explode('?' ,$_SERVER['REQUEST_URI']);
	$rutas = explode('/' ,$rutas[0]);
}else{
	$rutas = explode('/' ,$_SERVER['REQUEST_URI']);
}

if(isset($rutas[2]) ){
	$tipo_entrada = get_term_by('slug', $rutas[2], 'tipos_entradas' );
}else{
	$tipo_entrada = false;
}


$municipio = get_term_by('slug', $rutas[1], 'category' );
$catfull = '';

if( !$tipo_entrada && !isset($tipo_entrada) ){
	
	$tipo = $rutas[2];
	$municipio_s = $rutas[1];
	
	$titulo = $municipio->name.': <span>'.$tipo_entrada->name.'</span>';

	/*Se setea el diseño para una deterinada categoria*/
	$catdesign2 = ['comercio', 'hospedaje', 'gastronomia']; 
	$catdesign3 = ['sitios', 'emergencias']; 
	$catdesign4 = ['diversion', 'ferias-y-fiestas']; 
	
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
	if(isset($municipio->name)){
		$titulo =  $municipio->name;
	}else{
		$titulo =  $rutas[1].': '.$rutas[2];
	}
	
	$catopt = 1;
	$tipo = null;
	$municipio_s = $rutas[1];
/**Cerramos comparacion si es municipio o si es una categoria interna */
} 

if(!isset($_GET["busqueda"])){
					
	global $wpdb;
	
	if($municipio && !$tipo_entrada){

		$value = $wpdb->get_results( "SELECT * FROM $wpdb->postmeta WHERE meta_value = ".$municipio->term_id." AND meta_key = 'municipio'" );

		echo '<script type="text/javascript">
				var municipio = "'.$rutas[1].'"; </script>';
		
	}

	if($tipo_entrada){
		
		$query = "SELECT * FROM $wpdb->postmeta WHERE meta_value = '".$rutas[1]."/".$rutas[2]."'";
		
		$value = $wpdb->get_results( $query );						

	}
	
	if( isset($value) && !empty($value) ){
		
		$slider = get_post_meta( $value[0]->post_id, 'banner_superior');

		if (!empty($slider)) { 
			
			echo do_shortcode($slider[0]);
		}
		
	}
}

if(!isset($slider[0]) || $slider[0] === ''){
?>
<div class="mkdf-title-holder mkdf-standard-type" style="height: 300px" data-height="300">
	<div class="mkdf-title-wrapper" style="height: 300px">
		<div class="mkdf-title-inner">
			<div class="mkdf-grid">
				<h1 class="mkdf-page-title entry-title"><?php echo $titulo ?></h1>
				
				<?php if(isset($_GET["busqueda"])){
					
					$results = __('Resultados de busqueda para: ', 'serlib').$_GET["busqueda"];
					
					if(isset($_GET["tags"])){
						
						$results .=__(' y tags: ', 'serlib').$_GET["tags"];
					}
					
					echo '<p class="results_search_title">'.$results.'</p>';
				} ?>
				
			</div>
		</div>
	</div>
</div>

<?php }  ?>
<div class=" <?php echo $catfull.' '. esc_attr( $mkdf_holder_params['holder'] ); ?>">
	<?php do_action( 'roam_mikado_after_container_open' ); ?>
	
	<div class="<?php echo esc_attr( $mkdf_holder_params['inner'] ); ?>">
			
			<?php  				
						
				if(!isset($_GET["busqueda"])){
						
					if( isset($value) && !empty($value) ){
						
						$relacionado_post = get_post($value[0]->post_id);
						$content = $relacionado_post->post_content;
						$content = apply_filters('the_content', $content);
						$content = str_replace(']]>', ']]&gt;', $content);
						echo $content;
					}
					
				}
				/*
				if($municipio && !$tipo_entrada && !isset($_GET['busqueda'])){
					// categorias
					get_template_part( 'templates-fovea/categoria-municipio' );
					
					do_shortcode('[serlib_buscador_home_results_blog tipo_usuario="gobernacion" destino]');

					do_shortcode('[serlib_buscador_home_results_blog tipo_usuario="alcaldia" destino]');
					
					do_shortcode('[serlib_buscador_home_results_blog tipo_usuario="aliado" destino]');
				}*/

			?>
					
		<?php 
			
			if($municipio && !$tipo_entrada && !isset($_GET['busqueda'])){
				
				//get_template_part( 'templates-fovea/categoria-municipio' );
				
			}else{

			
				
				if($catopt === 1){
					get_template_part( 'templates-fovea/categoria' );
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

			}
		?>
	</div>
	
	<?php do_action( 'roam_mikado_before_container_close' ); ?>
</div>
<div class="publicidad">
			<?php 
				if( isset($value) && !empty($value) ){
					
					$slider = get_post_meta( $value[0]->post_id, 'banner_inferior');
					if (!empty($slider)) { 
						echo do_shortcode($slider[0]);
					}
						
				}
			?>
</div>
<?php 
do_action( 'roam_mikado_blog_list_additional_tags' ); 

get_footer(); 
?>