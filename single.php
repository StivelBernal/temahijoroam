<?php

get_header();

$terms = get_the_terms( $post->ID , 'tipos_entradas' );

$tipos_alcaldia = ['emergencias', 'transporte' ];
/**Aqui se podria colocar roles */
if(in_array($terms[0]->slug, $tipos_alcaldia)){

	get_template_part( 'fovea-gobierno-template' );
	/**solo tres la ubicacion las (redes-contenido) comentarios*/

}else{
	get_template_part( 'fovea-comercio-template' );
}
var_dump($post->author);
do_shortcode('[ser_like_share]');


get_footer(); 


?>