<div class="metodo">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 padding20">
				<?php 
				$text = $xml_code->content->left->text;
				for ($i=0; $i<count($text); $i++) {
					echo '<p>'.$text[$i]->$_SESSION['lang'].'</p>';
				}
				?>
			</div>
			<div class="col-sm-6 padding20">
				<?php 
				$text = $xml_code->content->right->text;
				for ($i=0; $i<count($text); $i++) {
					echo '<p>'.$text[$i]->$_SESSION['lang'].'</p>';
				}
				?>
			</div>
			<div class="col-xs-12 padding20">
				<p class="titulo_equipo"><?php echo $xml_code->content->title->$_SESSION['lang'] ?></p>
			</div>
		</div>
	</div>
</div>
<?php
$unidades = $xml_code->unidad;
for ($i=0; $i<count($unidades); $i++) {
	echo '<div class="unidad">';
		echo '<div class="titulo_caracteristica">'.$unidades[$i]->title->$_SESSION['lang'].'</div>';
		echo '<div class="txt_unidad">';
			echo '<div class="container">';
				echo '<div class="txt_unidad_center">';
					$text = $unidades[$i]->text;
					if (count($text) > 0) {
						for ($j=0; $j<count($text); $j++) {
							echo '<p>'.$text[$j]->$_SESSION['lang'].'</p>';
							if (isset($text[$j]->left->ul)) {
								echo '<div class="col-sm-6"><ul>';
									if (count($text[$j]->left->ul->li) > 0) {
										for ($k=0; $k<count($text[$j]->left->ul->li); $k++) {
											echo '<li>'.$text[$j]->left->ul->li[$k]->$_SESSION['lang'].'</li>';
										}
									} else {
										echo '<li>'.$text[$j]->left->ul->li->$_SESSION['lang'].'</li>';
									}
								echo '</ul></div>';
							}
							if (isset($text[$j]->right->ul)) {
								echo '<div class="col-sm-6"><ul>';
									if (count($text[$j]->right->ul->li) > 0) {
										for ($k=0; $k<count($text[$j]->right->ul->li); $k++) {
											echo '<li>'.$text[$j]->right->ul->li[$k]->$_SESSION['lang'].'</li>';
										}
									} else {
										echo '<li>'.$text[$j]->right->ul->li->$_SESSION['lang'].'</li>';
									}
								echo '</ul></div>';
							}
						}
					} else {
						echo '<p">'.$text->$_SESSION['lang'].'</p>';
						if (isset($text->left->ul)) {
							echo '<div class="col-sm-6"><ul>';
							if (count($text->left->ul->li) > 0) {
								for ($k=0; $k<count($text->left->ul->li); $k++) {
									echo '<li>'.$text->left->ul->li[$k]->$_SESSION['lang'].'</li>';
								}
							} else {
								echo '<li>'.$text->left->ul->li->$_SESSION['lang'].'</li>';
							}
							echo '</div></ul>';
						}
						if (isset($text->right->ul)) {
							echo '<div class="col-sm-6"><ul>';
							if (count($text->right->ul->li) > 0) {
								for ($k=0; $k<count($text->right->ul->li); $k++) {
									echo '<li>'.$text->right->ul->li[$k]->$_SESSION['lang'].'</li>';
								}
							} else {
								echo '<li>'.$text->right->ul->li->$_SESSION['lang'].'</li>';
							}
							echo '</div></ul>';
						}
					}
				echo '</div>';
				if (isset($unidades[$i]->left) || isset($unidades[$i]->right)) {
					echo '<div class="row">';
						echo '<div class="col-xs-12">';
							if (isset($unidades[$i]->left)) {
								echo '<div class="col-sm-6">';
									$text = $unidades[$i]->left->text;
									if (count($text) > 0) {
										for ($j=0; $j<count($text); $j++) {
											echo '<p>'.traducirStringXml($text[$j]->$_SESSION['lang']).'</p>';
											if (isset($text[$j]->ul)) {
												echo '<ul>';
													if (count($text[$j]->ul->li) > 0) {
														for ($k=0; $k<count($text[$j]->ul->li); $k++) {
															echo '<li>'.traducirStringXml($text[$j]->ul->li[$k]->$_SESSION['lang']).'</li>';
														}
													} else {
														echo '<li>'.traducirStringXml($text[$j]->ul->li->$_SESSION['lang']).'</li>';
													}
												echo '</ul>';
											}
										}
									} else {
										echo '<p>'.traducirStringXml($text->$_SESSION['lang']).'</p>';
										if (isset($text->ul)) {
											echo '<ul>';
											if (count($text->ul->li) > 0) {
												for ($k=0; $k<count($text->ul->li); $k++) {
													echo '<li>'.traducirStringXml($text->ul->li[$k]->$_SESSION['lang']).'</li>';
												}
											} else {
												echo '<li>'.traducirStringXml($text->ul->li->$_SESSION['lang']).'</li>';
											}
											echo '</ul>';
										}
									}
								echo '</div>';
							}
							if (isset($unidades[$i]->right)) {
								echo '<div class="col-sm-6">';
									$text = $unidades[$i]->right->text;
									if (count($text) > 0) {
										for ($j=0; $j<count($text); $j++) {
											echo '<p>'.traducirStringXml($text[$j]->$_SESSION['lang']).'</p>';
											if (isset($text[$j]->ul)) {
												echo '<ul>';
													if (count($text[$j]->ul->li) > 0) {
														for ($k=0; $k<count($text[$j]->ul->li); $k++) {
															echo '<li>'.traducirStringXml($text[$j]->ul->li[$k]->$_SESSION['lang']).'</li>';
														}
													} else {
														echo '<li>'.traducirStringXml($text[$j]->ul->li->$_SESSION['lang']).'</li>';
													}
												echo '</ul>';
											}
										}
									} else {
										echo '<p>'.traducirStringXml($text->$_SESSION['lang']).'</p>';
										if (isset($text->ul)) {
											echo '<ul>';
											if (count($text->ul->li) > 0) {
												for ($k=0; $k<count($text->ul->li); $k++) {
													echo '<li>'.traducirStringXml($text->ul->li[$k]->$_SESSION['lang']).'</li>';
												}
											} else {
												echo '<li>'.traducirStringXml($text->ul->li->$_SESSION['lang']).'</li>';
											}
											echo '</ul>';
										}
									}
								echo '</div>';
							}
						echo '</div>';
					echo '</div>';
				}
				if (isset($unidades[$i]->subtext)) {
					echo '<div class="txt_unidad_center">';
						$text = $unidades[$i]->subtext;
						if (count($text) > 0) {
							for ($j=0; $j<count($text); $j++) {
								echo '<p>'.traducirStringXml($text[$j]->$_SESSION['lang']).'</p>';
								if (isset($text[$j]->left->ul) || isset($text[$j]->right->ul)) {
									echo '<div class="row">';
										if (isset($text[$j]->left->ul)) {
											$ul = $text[$j]->left->ul;
											echo '<div class="col-sm-6"><ul>';
												if (count($ul->li) > 0) {
													for ($k=0; $k<count($ul->li); $k++) {
														echo '<li>'.traducirStringXml($ul->li[$k]->$_SESSION['lang']).'</li>';
													}
												} else {
													echo '<li>'.traducirStringXml($ul->li->$_SESSION['lang']).'</li>';
												}
											echo '</ul></div>';
										}
										if (isset($text[$j]->right->ul)) {
											$ul = $text[$j]->right->ul;
											echo '<div class="col-sm-6"><ul>';
												if (count($ul->li) > 0) {
													for ($k=0; $k<count($ul->li); $k++) {
														echo '<li>'.traducirStringXml($ul->li[$k]->$_SESSION['lang']).'</li>';
													}
												} else {
													echo '<li>'.traducirStringXml($ul->li->$_SESSION['lang']).'</li>';
												}
											echo '</ul></div>';
										}
									echo '</div>';
								}
							}
						} else {
							echo '<p>'.traducirStringXml($text->$_SESSION['lang']).'</p>';
							if (isset($text->left->ul) || isset($text->right->ul)) {
								echo '<div class="row">';
									if (isset($text->left->ul)) {
										$ul = $text->left->ul;
										echo '<div class="col-sm-6"><ul>';
											if (count($ul->li) > 0) {
												for ($k=0; $k<count($ul->li); $k++) {
													echo '<li>'.traducirStringXml($ul->li[$k]->$_SESSION['lang']).'</li>';
												}
											} else {
												echo '<li>'.traducirStringXml($ul->li->$_SESSION['lang']).'</li>';
											}
										echo '</ul></div>';
									}
									if (isset($text->right->ul)) {
										$ul = $text->right->ul;
										echo '<div class="col-sm-6"><ul>';
											if (count($ul->li) > 0) {
												for ($k=0; $k<count($ul->li); $k++) {
													echo '<li>'.traducirStringXml($ul->li[$k]->$_SESSION['lang']).'</li>';
												}
											} else {
												echo '<li>'.traducirStringXml($ul->li->$_SESSION['lang']).'</li>';
											}
										echo '</ul></div>';
									}
								echo '</div>';
							}
						}
					echo '</div>';
				}
			echo '</div>';
		echo '</div>';
		echo '<div class="equipo_unidad">';
			echo '<div class="container">';
				echo '<div class="row">';
					echo '<div class="col-xs-12">';
						echo '<p class="titulo_equipo">'.$unidades[$i]->subtitle->$_SESSION['lang'].'</p>';
					echo '</div>';
					echo '<div class="col-xs-12">';
						if (isset($unidades[$i]->team->section)) {
							$secciones = $unidades[$i]->team->section;
							for ($j=0; $j<count($secciones); $j++) {
								echo '<div class="row">';
									echo '<p class="subtitulo_equipo">'.$secciones[$j]->name->$_SESSION['lang'].'</p>';
									if (count($secciones[$j]->person) > 0) {
										for ($k=0; $k<count($secciones[$j]->person); $k++) {
											echo '<div class="col-sm-4 person col-xs-6">';
												echo '
												<div class="name_person">'.$secciones[$j]->person[$k]->name->$_SESSION['lang'].'</div>
												<img title="'.$secciones[$j]->person[$k]->alt->$_SESSION['lang'].'" alt="'.$secciones[$j]->person[$k]->alt->$_SESSION['lang'].'" src="/img/equipo/'.$secciones[$j]->person[$k]->img.'">
												<div class="education_person">'.$secciones[$j]->person[$k]->education->$_SESSION['lang'].'</div>
												';
											echo '</div>';
										}
									} else {
										echo '<div class="col-sm-4 person col-xs-6">';
											echo '
											<div class="name_person">'.$secciones[$j]->person->name->$_SESSION['lang'].'</div>
											<img title="'.$secciones[$j]->person->alt->$_SESSION['lang'].'" alt="'.$secciones[$j]->person->alt->$_SESSION['lang'].'" src="/img/equipo/'.$secciones[$j]->person->img.'">
											<div class="education_person">'.$secciones[$j]->person->education->$_SESSION['lang'].'</div>
											';
										echo '</div>';
									}
								echo '</div>';
							}
						} else {
							$personas = $unidades[$i]->team->person;
							if (count($personas) > 0) {
								for ($k=0; $k<count($personas); $k++) {
									echo '<div class="col-sm-4 person col-xs-6">';
										echo '
										<div class="name_person">'.$personas[$k]->name->$_SESSION['lang'].'</div>
										<img title="'.$personas[$k]->alt->$_SESSION['lang'].'" alt="'.$personas[$k]->alt->$_SESSION['lang'].'" src="/img/equipo/'.$personas[$k]->img.'">
										<div class="education_person">'.$personas[$k]->education->$_SESSION['lang'].'</div>
										';
									echo '</div>';
								}
							} else {
								echo '<div class="col-sm-4 person col-xs-6">';
									echo '
									<div class="name_person">'.$personas->name->$_SESSION['lang'].'</div>
									<img title="'.$personas->alt->$_SESSION['lang'].'" alt="'.$personas->alt->$_SESSION['lang'].'" src="/img/equipo/'.$personas->img.'">
									<div class="education_person">'.$personas->education->$_SESSION['lang'].'</div>
									';
								echo '</div>';
							}
						}
					echo '</div>';
				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
}
?>