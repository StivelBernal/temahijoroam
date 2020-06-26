<?php
if (post_password_required()) {
	return;
}

if (comments_open() || get_comments_number()) { ?>
<div ng-app="comments" ng-controller="commentsController">
	<div class="mkdf-comment-holder clearfix" id="comments" >
		<?php if (have_comments()) { ?>
			<div class="mkdf-comment-holder-inner">
				<div class="mkdf-comments-title">
					<h4><?php esc_html_e('Comentarios:', 'roam'); ?></h4>
				</div>
				<div class="mkdf-comments">
					<ul class="mkdf-comment-list">
						<?php wp_list_comments(array_unique(array_merge(array('callback' => 'roam_mikado_comment'), apply_filters('roam_mikado_comments_callback', array())))); ?>
					</ul>
				</div>
			</div>
		<?php } ?>
		<?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) { ?>
			<p><?php esc_html_e('Lo sentimos, el formulario de comentarios está cerrado en este momento.', 'roam'); ?></p>
		<?php } ?>
	</div>
	
	<?php 
	
		$user = wp_get_current_user();	
		// obtener las forma de calificar y si no una default que solo sea por extrellas
	?>

	<div class="mkdf-comment-form">
		<div class="mkdf-comment-form-inner">
			<div id="respond" class="comment-respond">
				<h4 id="reply-title" class="comment-reply-title"><?php __('Deja una reseña:', 'roam'); ?><small><a rel="nofollow" id="cancel-comment-reply-link" href="/todos/emergencias/anuncio-gobernacion-2/#respond" style="display:none;">cancel reply</a></small></h4>
				<form name="commentform" id="commentform" class="comment-form">
					<div class="row-wrap items_calificacion_row">
					
					<?php  
					
					$rutas = explode('/' ,$_SERVER['REQUEST_URI']);
					
					
					if(isset($rutas[2]) ){
						$tipo_entrada = get_term_by('slug', $rutas[2], 'tipos_entradas' );
					}


					if($tipo_entrada){
		

						$query = "SELECT * FROM $wpdb->postmeta WHERE meta_value = '".$rutas[1]."/".$rutas[2]."'";
						
						$value = $wpdb->get_row( $query );	
						
						$items_calificacion = get_post_meta($value->post_id, 'items_de_calificacion');

						$items_calificacion = explode(',', $items_calificacion[0]);

						echo '<script> var items_calificaciones = '.json_encode($items_calificacion, true ).'</script>';

						for($i = 0; $i < count($items_calificacion); $i++){

							?>
							<div class="item_calificacion s-20">
								<div class="t"><?php echo $items_calificacion[$i]; ?></div>
								<div class="estrellas" ng-class="{ 'is_rate': star !== 0 }" ng-mouseleave="(item_selected[<?php echo $i ?>] ? item_star[<?php echo $i ?>] = item_selected[<?php echo $i ?>][0] : item_star[<?php echo $i ?>] = 0)" ng-init="item_star[<?php echo $i ?>] = 0">
									<i class="fa fa-star-o text-success" ng-class="{ 'fa-star-o': item_star[<?php echo $i ?>] < 1, 'fa-star': item_star[<?php echo $i ?>] > 0 }"   str="1" aria-hidden="true"   ng-mouseenter="item_star[<?php echo $i ?>] = 1"  
										ng-click="set_star( 1 , <?php echo $i; ?>, '<?php echo $items_calificacion[$i]; ?>' )"></i>
									<i class="fa fa-star-o text-success" ng-class="{ 'fa-star-o': item_star[<?php echo $i ?>] < 2, 'fa-star': item_star[<?php echo $i ?>] > 1 }"   str="2" aria-hidden="true"  ng-mouseenter="item_star[<?php echo $i ?>] = 2" 
										  ng-click="set_star( 2 , <?php echo $i; ?>, '<?php echo $items_calificacion[$i]; ?>' )"></i>
									<i class="fa fa-star-o text-success" ng-class="{ 'fa-star-o': item_star[<?php echo $i ?>] < 3, 'fa-star': item_star[<?php echo $i ?>] > 2 }"   str="3" aria-hidden="true"  ng-mouseenter="item_star[<?php echo $i ?>] = 3" 
										  ng-click="set_star( 3 , <?php echo $i; ?>, '<?php echo $items_calificacion[$i]; ?>' )"></i>
									<i class="fa fa-star-o text-success" ng-class="{ 'fa-star-o': item_star[<?php echo $i ?>] < 4, 'fa-star': item_star[<?php echo $i ?>] > 3 }"   str="4" aria-hidden="true"  ng-mouseenter="item_star[<?php echo $i ?>] = 4"  
										 ng-click="set_star( 4 , <?php echo $i  ?>, '<?php echo $items_calificacion[$i]; ?>' )"></i> 
									<i class="fa fa-star-o text-success" ng-class="{ 'fa-star-o': item_star[<?php echo $i ?>] < 5, 'fa-star': item_star[<?php echo $i ?>] === 5 }" str="5" aria-hidden="true"  ng-mouseenter="item_star[<?php echo $i ?>] = 5" 
										  ng-click="set_star( 5 , <?php echo $i; ?>,  '<?php echo $items_calificacion[$i]; ?>' )"></i> 
								</div>;
							</div>

							<?php

						}
				
					}
					
					
					?>
					</div>
					
					<textarea id="comment" placeholder="<?php echo __('Escribe tu reseña', 'roam'); ?>" name="comment" cols="45" rows="6" aria-required="true"></textarea>
					
					

					<div>
						<button ng-click="submit()" ng-disabled="loginForm.$invalid" class="bttn default s-100">
							<?php echo __('Publicar reseña', 'roam'); ?></button>
					</div>
				</form>
			</div><!-- #respond -->
		</div>
	</div>
</div>


<?php  } ?>