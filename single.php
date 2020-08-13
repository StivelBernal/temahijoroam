<?php

get_header();

$terms = get_the_terms( $post->ID , 'tipos_entradas' );

$tipos_alcaldia = ['emergencias', 'transporte' ];
/**Aqui se podria colocar roles */


if(get_userdata($post->post_author)->roles[0] !== 'comerciante'){

	get_template_part( 'fovea-gobierno-template' );
	/**solo tres la ubicacion las (redes-contenido) comentarios*/

}else{

	get_template_part( 'fovea-comercio-template' );

}

do_shortcode('[ser_like_share]');


get_footer(); 


?>