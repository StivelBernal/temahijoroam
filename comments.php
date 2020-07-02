<?php
if (post_password_required()) {
	return;
}

if (comments_open() || get_comments_number()) { ?>
	<div ng-app="comments" ng-controller="commentsController">
		<div class="mkdf-comment-holder clearfix" id="comments">

			<?php if (have_comments()) { ?>
				<div class="mkdf-comment-holder-inner">
					<div class="mkdf-comments-title">
						<h4><?php comments_number();  ?></h4>
					</div>
					<div class="mkdf-comments">
						<ul class="mkdf-comment-list">

							<?php

							foreach ($comments as $comment) {

								if ($comment->comment_parent === "0") {

									$child_comm =  get_comments([
										'status'    => 'approve',
										'order'     => 'DESC',
										'parent'    => $comment->comment_ID
									]);



							?>



									<li class="comment byuser comment-author-brayan bypostauthor even thread-even depth-1">
										<div class="mkdf-comment clearfix mkdf-post-author-comment">
											<div class="mkdf-comment-image">
												<img alt="<?php

															$user = wp_get_current_user();
															
															$user_photo = get_user_meta( get_user_by('email', $comment->comment_author_email )->ID, 'user_photo', true);

															$user_photo                = str_replace(
																[
																	'/home/brayan/Escritorio/FOVEA', '/home/u135059516/domains/golfodemorrosquillo.com/public_html',
																	'/home/u135059516/domains/golfodemorrosquillo.co/public_html', '/home/u135059516/domains/golfodemorrosquillo.com.co/public_html'
																],
																'',
																$user_photo
															);

															if (!$user_photo) {
																$user_photo = '/wp-content/plugins/ser_lib/assets/img/avatar-default.jpg';
															}

															echo comment_author(); ?>" class="avatar photo" src="<?php echo $user_photo; ?>">

											</div>
											<div class="mkdf-comment-text">
												<div class="mkdf-comment-info">
													<h4 class="mkdf-comment-name vcard">
														<a target="_blank"><?php comment_author(); ?></a> </h4>
													<div class="mkdf-comment-date"><?php $de = __('\d\e', 'roam_child');
																					_e('el', 'roam_child');
																					comment_date(' j ' . $de . ' F, Y / g:i a') ?></div>
												</div>
												<div class="stars_r_c row-wrap">

													<?php

													$stars_items_r =  get_comment_meta(get_comment_ID(), 'stars_items');

													if (!empty($stars_items_r)) {
														$stars_items_r = $stars_items_r[0];
														for ($i = 0; $i < count($stars_items_r); $i++) {
															echo '
															<div class="item_calificacion s-20">
																<div class="t">' . $stars_items_r[$i]->label . '</div>
																	<div class="estrellas">';
															switch ($stars_items_r[$i]->value) {
																case 1:
																	echo '
																	<i class="fa text-success fa-star" aria-hidden="true" ></i>
																	<i class="fa text-success fa-star-o" aria-hidden="true" ></i>
																	<i class="fa text-success fa-star-o" aria-hidden="true" ></i>
																	<i class="fa fa-star-o text-success" aria-hidden="true" ></i>
																	<i class="fa fa-star-o text-success" aria-hidden="true" ></i>																	
																	';
																	break;
																case 2:
																	echo '
																	<i class="fa text-success fa-star" aria-hidden="true" ></i>
																	<i class="fa text-success fa-star" aria-hidden="true" ></i>
																	<i class="fa text-success fa-star-o" aria-hidden="true" ></i>
																	<i class="fa fa-star-o text-success" aria-hidden="true" ></i>
																	<i class="fa fa-star-o text-success" aria-hidden="true" ></i>																	
																	';
																	break;
																case 3:
																	echo '
																	<i class="fa text-success fa-star" aria-hidden="true" ></i>
																	<i class="fa text-success fa-star" aria-hidden="true" ></i>
																	<i class="fa text-success fa-star" aria-hidden="true" ></i>
																	<i class="fa fa-star-o text-success" aria-hidden="true" ></i>
																	<i class="fa fa-star-o text-success" aria-hidden="true" ></i>																	
																	';
																	break;
																case 4:
																	echo '
																	<i class="fa text-success fa-star" aria-hidden="true" ></i>
																	<i class="fa text-success fa-star" aria-hidden="true" ></i>
																	<i class="fa text-success fa-star" aria-hidden="true" ></i>
																	<i class="fa fa-star" text-success" aria-hidden="true" ></i>
																	<i class="fa fa-star-o text-success" aria-hidden="true" ></i>																	
																	';
																	break;
																case 5:
																	echo '
																	<i class="fa text-success fa-star" aria-hidden="true" ></i>
																	<i class="fa text-success fa-star" aria-hidden="true" ></i>
																	<i class="fa text-success fa-star" aria-hidden="true" ></i>
																	<i class="fa fa-star text-success" aria-hidden="true" ></i>
																	<i class="fa fa-star text-success" aria-hidden="true" ></i>																	
																	';
																	break;
															}

															echo '</div>
															</div>';
														}
													}

													?>

												</div>

												<div class="mkdf-text-holder" id="comment-6">

													<p><?php comment_text(); ?></p>
												</div>

												<div class="stars_r_c">
													<?php

													$galeria =  get_comment_meta(get_comment_ID(), 'comments_media');

													if (!empty($galeria[0])) {
														for ($i = 0; $i < count($galeria[0]); $i++) {
															echo '<img class="galery-c-i" src="' . $galeria[0][$i] . '" >';
														}
													}

													?>
												</div>
												<?php if (is_user_logged_in()) { ?>

													<a rel="nofollow" class="comment-reply-link" ng-click="reply(<?php echo get_comment_ID(); ?>,$event)" aria-label="<?php echo __('Responder a ', 'roam_child') . comment_author(); ?>"><?php echo __('Responder', 'roam_child'); ?> </a>
													<?php if ($comment->user_id == $user->ID) {
														echo '<a ng-click="delete_comment(' . get_comment_ID() . ', $event) " class="comment_delete" > ' . __('Eliminar', 'roam_child') . '</a>';
													} ?>

												<?php } ?>
											</div>
										</div>

										<?php

										if (!empty($child_comm)) {

											for ($i = 0; $i < count($child_comm); $i++) {
												
												
												$user_photo_child = get_user_meta( get_user_by('email', $child_comm[$i]->comment_author_email)->ID , 'user_photo', true );

												$user_photo_child                = str_replace(
													[
														'/home/brayan/Escritorio/FOVEA', '/home/u135059516/domains/golfodemorrosquillo.com/public_html',
														'/home/u135059516/domains/golfodemorrosquillo.co/public_html', '/home/u135059516/domains/golfodemorrosquillo.com.co/public_html'
													],
													'',
													$user_photo_child
												);

												if (!$user_photo_child) {
													$user_photo_child = '/wp-content/plugins/ser_lib/assets/img/avatar-default.jpg';
												}
										?>

											<div class="mkdf-comment comment_child clearfix mkdf-post-author-comment">
												<div class="mkdf-comment-image">
													<img alt="<?php echo $child_comm[$i]->comment_author ?>" class="avatar photo" src="<?php echo $user_photo_child; ?>">
												</div>
												<div class="mkdf-comment-text">
													<div class="mkdf-comment-info">
														<h5 class="mkdf-comment-name vcard">
															<a target="_blank"><?php echo $child_comm[$i]->comment_author ?></a> </h5>
														<div class="mkdf-comment-date"><?php $de = __('\d\e', 'roam_child');
																					_e('el', 'roam_child');
																					echo date( ' j ' . $de . ' F, Y / g:i a', strtotime($child_comm[$i]->comment_date )); ?></div>
													</div>
													

													<div class="mkdf-text-holder" id="comment-6">

														<p><?php echo $child_comm[$i]->comment_content ?></p>
														
													</div>

													<div class="stars_r_c">
														<?php 

														$galeria_child =  get_comment_meta($child_comm[$i]->comment_ID, 'comments_media');

														if (!empty($galeria_child[0])) {
															for ($j = 0; $j < count($galeria_child[0]); $j++) {
																echo '<img class="galery-c-i" src="' . $galeria_child[0][$j] . '" >';
															}
														}
													
														if ( $child_comm[$i]->user_id == get_current_user_id() ) { ?>
														<a ng-click="delete_comment(<?php echo $child_comm[$i]->comment_ID ?>, $event, true) " class="comment_delete"> Eliminar</a>
														
														<?php
														} 
														?>
												
												</div>
											</div>


										<?php

											}
										}

										?>
									</li>



							<?php

								}
								/**Finaliza condicion de reply y despues el foreach  */
							}

							the_comments_pagination();

							?>




						</ul>
					</div>
				</div>
			<?php } ?>
			<?php if (!comments_open() && get_comments_number() && post_type_supports(get_post_type(), 'comments')) { ?>
				<p><?php esc_html_e('Lo sentimos, el formulario de comentarios está cerrado en este momento.', 'roam_child'); ?></p>
			<?php } ?>
		</div>

		<?php

		$user = wp_get_current_user();
		// obtener las forma de calificar y si no una default que solo sea por extrellas
		?>

		<div class="mkdf-comment-form">
			<div class="mkdf-comment-form-inner">
				<div id="respond" class="comment-respond">
					<h4 id="reply-title" class="comment-reply-title"><?php __('Deja una reseña:', 'roam'); ?></h4>
					<form name="commentform" id="commentform" class="comment-form">
						<div class="row-wrap center-center items_calificacion_row" ng-if="!reply_id">

							<?php

							$rutas = explode('/', $_SERVER['REQUEST_URI']);


							if (isset($rutas[2])) {
								$tipo_entrada = get_term_by('slug', $rutas[2], 'tipos_entradas');
							}


							if ($tipo_entrada) {


								$query = "SELECT * FROM $wpdb->postmeta WHERE meta_value = '" . $rutas[1] . "/" . $rutas[2] . "'";

								$value = $wpdb->get_row($query);
								if ($value) {
									$items_calificacion = get_post_meta($value->post_id, 'items_de_calificacion');

									$items_calificacion = explode(',', $items_calificacion[0]);
								} else {
									$items_calificacion = [];
								}


								echo '<script> var post_id = ' . get_the_ID() . '</script>';

								for ($i = 0; $i < count($items_calificacion); $i++) {
									
									if( count($items_calificacion) === 2 ){

									?>

										<div class="item_calificacion s-50">
											<div class="t"><?php echo $items_calificacion[$i]; ?></div>
											<div class="estrellas" ng-class="{ 'is_rate': star !== 0 }" ng-mouseleave="(item_selected[<?php echo $i ?>] ? item_star[<?php echo $i ?>] = item_selected[<?php echo $i ?>][0] : item_star[<?php echo $i ?>] = 0)" ng-init="item_star[<?php echo $i ?>] = 0">
												<i title="<?php echo __('malo', 'roam_child'); ?> " class="fa fa-star-o text-success" ng-class="{ 'fa-star-o': item_star[<?php echo $i ?>] < 1, 'fa-star': item_star[<?php echo $i ?>] > 0 }" str="1" aria-hidden="true" ng-mouseenter="item_star[<?php echo $i ?>] = 1" ng-click="set_star( 1 , <?php echo $i; ?>, '<?php echo $items_calificacion[$i]; ?>' )"></i>
												<i title="<?php echo __('regular', 'roam_child'); ?> " class="fa fa-star-o text-success" ng-class="{ 'fa-star-o': item_star[<?php echo $i ?>] < 2, 'fa-star': item_star[<?php echo $i ?>] > 1 }" str="2" aria-hidden="true" ng-mouseenter="item_star[<?php echo $i ?>] = 2" ng-click="set_star( 2 , <?php echo $i; ?>, '<?php echo $items_calificacion[$i]; ?>' )"></i>
												<i title="<?php echo __('normal', 'roam_child'); ?> " class="fa fa-star-o text-success" ng-class="{ 'fa-star-o': item_star[<?php echo $i ?>] < 3, 'fa-star': item_star[<?php echo $i ?>] > 2 }" str="3" aria-hidden="true" ng-mouseenter="item_star[<?php echo $i ?>] = 3" ng-click="set_star( 3 , <?php echo $i; ?>, '<?php echo $items_calificacion[$i]; ?>' )"></i>
												<i title="<?php echo __('bueno', 'roam_child'); ?> " class="fa fa-star-o text-success" ng-class="{ 'fa-star-o': item_star[<?php echo $i ?>] < 4, 'fa-star': item_star[<?php echo $i ?>] > 3 }" str="4" aria-hidden="true" ng-mouseenter="item_star[<?php echo $i ?>] = 4" ng-click="set_star( 4 , <?php echo $i  ?>, '<?php echo $items_calificacion[$i]; ?>' )"></i>
												<i title="<?php echo __('excelente', 'roam_child'); ?> " class="fa fa-star-o text-success" ng-class="{ 'fa-star-o': item_star[<?php echo $i ?>] < 5, 'fa-star': item_star[<?php echo $i ?>] === 5 }" str="5" aria-hidden="true" ng-mouseenter="item_star[<?php echo $i ?>] = 5" ng-click="set_star( 5 , <?php echo $i; ?>,  '<?php echo $items_calificacion[$i]; ?>' )"></i>
											</div>
										</div>


									<?php


										
									}else{

									
									?>
									
									<div class="item_calificacion s-field">
										<div class="t"><?php echo $items_calificacion[$i]; ?></div>
										<div class="estrellas" ng-class="{ 'is_rate': star !== 0 }" ng-mouseleave="(item_selected[<?php echo $i ?>] ? item_star[<?php echo $i ?>] = item_selected[<?php echo $i ?>][0] : item_star[<?php echo $i ?>] = 0)" ng-init="item_star[<?php echo $i ?>] = 0">
											<i title="<?php echo __('malo', 'roam_child'); ?> " class="fa fa-star-o text-success" ng-class="{ 'fa-star-o': item_star[<?php echo $i ?>] < 1, 'fa-star': item_star[<?php echo $i ?>] > 0 }" str="1" aria-hidden="true" ng-mouseenter="item_star[<?php echo $i ?>] = 1" ng-click="set_star( 1 , <?php echo $i; ?>, '<?php echo $items_calificacion[$i]; ?>' )"></i>
											<i title="<?php echo __('regular', 'roam_child'); ?> " class="fa fa-star-o text-success" ng-class="{ 'fa-star-o': item_star[<?php echo $i ?>] < 2, 'fa-star': item_star[<?php echo $i ?>] > 1 }" str="2" aria-hidden="true" ng-mouseenter="item_star[<?php echo $i ?>] = 2" ng-click="set_star( 2 , <?php echo $i; ?>, '<?php echo $items_calificacion[$i]; ?>' )"></i>
											<i title="<?php echo __('normal', 'roam_child'); ?> " class="fa fa-star-o text-success" ng-class="{ 'fa-star-o': item_star[<?php echo $i ?>] < 3, 'fa-star': item_star[<?php echo $i ?>] > 2 }" str="3" aria-hidden="true" ng-mouseenter="item_star[<?php echo $i ?>] = 3" ng-click="set_star( 3 , <?php echo $i; ?>, '<?php echo $items_calificacion[$i]; ?>' )"></i>
											<i title="<?php echo __('bueno', 'roam_child'); ?> " class="fa fa-star-o text-success" ng-class="{ 'fa-star-o': item_star[<?php echo $i ?>] < 4, 'fa-star': item_star[<?php echo $i ?>] > 3 }" str="4" aria-hidden="true" ng-mouseenter="item_star[<?php echo $i ?>] = 4" ng-click="set_star( 4 , <?php echo $i  ?>, '<?php echo $items_calificacion[$i]; ?>' )"></i>
											<i title="<?php echo __('excelente', 'roam_child'); ?> " class="fa fa-star-o text-success" ng-class="{ 'fa-star-o': item_star[<?php echo $i ?>] < 5, 'fa-star': item_star[<?php echo $i ?>] === 5 }" str="5" aria-hidden="true" ng-mouseenter="item_star[<?php echo $i ?>] = 5" ng-click="set_star( 5 , <?php echo $i; ?>,  '<?php echo $items_calificacion[$i]; ?>' )"></i>
										</div>
									</div>

							<?php
									}	
								}
							}


							?>
						</div>

						<div ng-if="reply_id" class="reply-info">
							<h4><?php echo __('Responder a comentario', 'roam_child'); ?> </h4>
							<div ng-click="cancel_reply()" class="reply-cancel"> Cancelar </div>
						</div>

						<textarea id="comment" placeholder="<?php echo __('Escribe tu reseña', 'roam'); ?>" name="comment" cols="45" rows="4" maxlength="300" ng-model="comment_text" aria-required="true"></textarea>

						<div class="row-wrap">

							<div class="s-25" ng-repeat="image in galery">
								<div class="galery-image-container">
									<div><img class="img-galeria" ng-src="{{preview_galery[$index] ? preview_galery[$index]: preview_default}}"></div>
									<span title="eliminar" ng-click="delete_image($index)" class="dashicons btnn-delete " role="button" tabindex="0"> <i class="fa fa-trash-o"></i></span>

								</div>

								<div class="form-group s-100">
									<label for="featured{{$index}}" class="input-file-label">{{ !galery[$index].name ? "<?php echo __('Seleccionar imagen', 'serlib'); ?>": galery[$index].name }} </label>
									<input class="input_file" type="file" ng-model="galery[$index]" indice="{{$index}}" preview-array="preview_galery" app-filereader accept="image/png, image/jpeg" app-filereader style="display:none;" id="featured{{$index}}">
								</div>
							</div>
						</div>

				</div>

				<div class="s-100 row end-center">

					<button class="btnn-add-galery" ng-click="add_galery()"><?php echo __('Agregar imagen', 'serlib') ?></button>

				</div>

				<div class="s-30">
					<button ng-click="submit()" ng-disabled="(!galery[0].name && comment_text === '' && item_selected.length === 0)" class="bttn default s-100">
						<div ng-if="is_submit" class="lds-ripple-small">
							<div></div>
							<div></div>
						</div><?php echo __('Publicar reseña', 'roam'); ?>
					</button>

				</div>
				<div class="row">
					<div class="s-30">
						<span style="color:red;">{{error}}</span>
						<span style="color:green;">{{success}}</span>
					</div>
				</div>

				</form>
			</div><!-- #respond -->
		</div>
	</div>
	</div>

	<div id="img-comment-preview">
		<div class="cerrar"><?php echo __('cerrar', 'serlib'); ?></div>
		<img src="http://localhost:4000/wp-content/uploads/2020/06/40992_profesionales-de-la-salud-estan-dispuestos-a-escuchar_1024x600-150x150.jpeg">
	</div>


<?php  } ?>