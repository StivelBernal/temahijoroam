<?php

get_header();

$terms = get_the_terms( $post->ID , 'tipos_entradas' );

$tipos_alcaldia = ['emergencias', 'transporte' ];

if(in_array($terms[0]->slug, $tipos_alcaldia)){

	get_template_part( 'fovea-gobierno-template' );

}else{
	get_template_part( 'fovea-comercio-template' );
	
}

get_footer(); ?>