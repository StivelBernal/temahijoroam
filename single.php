<?php

get_header();

$terms = get_the_terms( $post->ID , 'tipos_entradas' );


if(get_userdata($post->post_author)->roles[0] !== 'comerciante'){

	get_template_part( 'fovea-general-template' );

}else{

	get_template_part( 'fovea-comercio-template' );

}


get_footer(); 


?>