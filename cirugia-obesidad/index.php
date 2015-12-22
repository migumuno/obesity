<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>
<?php 
	if (isset($_GET['method']))
		$xml = 'cirugia-obesidad/'.$_GET['method'];
	else 
		$xml = 'cirugia-obesidad/metodo-apollo'; 
?>

<div class="metodo">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 padding20">
				<img title="<?php echo $xml_code->content->img->alt->$_SESSION['alt'] ?>" src="/img/<?php echo $xml_code->content->img->name ?>" alt="<?php echo $xml_code->content->img->alt->$_SESSION['alt'] ?>">
				<?php 
				if (isset($xml_code->content->description->text)) {
					$texto = $xml_code->content->description->text;
					if (count($texto) > 0) {
						echo '<div class="descripcion">';
							for ($i=0; $i<count($texto); $i++) {
								echo '<p>'.traducirStringXml($texto[$i]->$_SESSION['lang']).'</p>';
								if (isset($texto[$i]->ul)) {
									echo '<ul>';
										$lista = $texto[$i]->ul->li;
										for ($j=0; $j<count($lista); $j++) {
											echo '<li>';
												echo traducirStringXml($lista[$j]->$_SESSION['lang']);
												if (isset($lista[$j]->ul)) {
													echo '<ul>';
														for ($k=0; $k<count($lista[$j]->ul->li); $k++) {
															echo '<li>'.traducirStringXml($lista[$j]->ul->li[$k]->$_SESSION['lang']).'</li>';
														}
													echo '</ul>';
												}
											echo '</li>';
										}
									echo '</ul>';
								}
							}
						echo '</div>';
					} else {
						echo '<p>'.traducirStringXml($texto->$_SESSION['lang']).'</p>';
						if (isset($texto->ul)) {
							echo '<ul>';
							$lista = $texto->ul->li;
							for ($j=0; $j<count($lista); $j++) {
								echo '<li>';
								echo traducirStringXml($lista[$j]->$_SESSION['lang']);
								if (isset($lista[$j]->ul)) {
									echo '<ul>';
									for ($k=0; $k<count($lista[$j]->ul->li); $k++) {
										echo '<li>'.traducirStringXml($lista[$j]->ul->li[$k]->$_SESSION['lang']).'</li>';
									}
									echo '</ul>';
								}
								echo '</li>';
							}
							echo '</ul>';
						}
					}
				}
				?>
			</div>
			<div class="col-sm-6 padding20">
				<?php 
				if (isset($xml_code->content->treatment->title))
					echo '<div class="titulo_metodo">'.$xml_code->content->treatment->title->$_SESSION['lang'].'</div>';
				if (isset($xml_code->content->treatment->duration)) {
					echo '<div class="subtitulo_metodo">'.$diccionario->texts->duration->$_SESSION['lang'].':</div>
					<p>'.$xml_code->content->treatment->duration->$_SESSION['lang'].'</p>';
				}
				?>
				<div class="subtitulo_metodo"><?php echo $diccionario->texts->include->$_SESSION['lang'] ?>:</div>
				<?php 
				$texto = $xml_code->content->treatment->text;
				for ($i=0; $i<count($texto); $i++) {
					echo '<p>'.traducirStringXml($texto[$i]->$_SESSION['lang']).'</p>';
					if (isset($texto[$i]->ul)) {
						echo '<ul>';
							$lista = $texto[$i]->ul->li;
							for ($j=0; $j<count($lista); $j++) {
								echo '<li>';
									echo traducirStringXml($lista[$j]->$_SESSION['lang']);
									if ($lista[$j]->ul) {
										echo '<ul>';
											$sublista = $lista[$j]->ul->li;
											for ($k=0; $k<count($sublista); $k++) {
												echo '<li>'.traducirStringXml($sublista[$k]->$_SESSION['lang']).'</li>';
											}
										echo '</ul>';
									}
								echo '</li>';
							}
						echo '</ul>';
					}
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php if (isset($xml_code->content->cards)) { ?>
	<div class="caracteristicas_metodo">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<?php 
					$tarjetas = $xml_code->content->cards->item;
					for ($i=0; $i<count($tarjetas); $i++) {
						echo '
						<div class="col-md-3 col-sm-6 caracteristica_metodo">
							<div class="titulo_caracteristica">'.$tarjetas[$i]->title->$_SESSION['lang'].'</div>
							<div class="contenido_caracteristica">
								<div class="img_caracteristica"><img title="'.$tarjetas[$i]->alt->$_SESSION['lang'].'" src="/img/'.$tarjetas[$i]->img.'" alt="'.$tarjetas[$i]->alt->$_SESSION['lang'].'"></div>';
								if ($i < 4) echo '
								<div class="txt_caracteristica_metodo">';
								else echo '
								<div class="txt_caracteristica_metodo_min">';
									if (count($tarjetas[$i]->text) > 0) {
										for ($j=0; $j<count($tarjetas[$i]->text); $j++) {
											echo '<p>'.traducirStringXml($tarjetas[$i]->text[$j]->$_SESSION['lang']).'</p>';
										}
									} else {
										echo '<p>'.traducirStringXml($tarjetas[$i]->text->$_SESSION['lang']).'</p>';
									}
						echo '
								</div>
							</div>
						</div>';
					}
					?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>
<div class="info_metodo">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="col-md-6 resultados">
					<div class="contenido_info_metodo">
						<?php 
						if (isset($xml_code->content->results->title))
							echo '<div class="titulo_info_metodo">'.$xml_code->content->results->title->$_SESSION['lang'].'</div>';
						if (isset($xml_code->content->results->text))
							if (count($xml_code->content->results->text) > 0) {
								for ($i=0; $i<count($xml_code->content->results->text); $i++) {
									echo '<p>'.traducirStringXml($xml_code->content->results->text[$i]->$_SESSION['lang']).'</p>';
								}
							} else 
								echo '<p>'.traducirStringXml($xml_code->content->results->text->$_SESSION['lang']).'</p>';
						
						?>
					</div>
				</div>
				<div class="col-md-6 solicitud">
					<div class="contenido_info_metodo">
						<div class="titulo_info_metodo"><?php echo $xml_code->content->info->title->$_SESSION['lang'] ?></div>
						<div class="form">
							<form name="form_method" novalidate>
								<div class="row">
									<div class="col-xs-12">
										<div class="col-md-6 col-sm-12">
											<input ng-model="long.name" type="text" name="nombre" placeholder="<?php echo $diccionario->fields->name->$_SESSION['lang'] ?>" required>
											<div ng-show="form_method.nombre.$touched && !form_method.$pristine">
												<span ng-show="form_method.nombre.$error.required" class="alert"><?php echo $diccionario->alerts->name->$_SESSION['lang'] ?></span>
											</div>
											<textarea ng-model="long.message" name="message" rows="7" placeholder="<?php echo $diccionario->fields->textarea->$_SESSION['lang'] ?>" required></textarea>
											<div ng-show="form_method.message.$touched && !form_method.$pristine">
												<span ng-show="form_method.message.$error.required" class="alert"><?php echo $diccionario->alerts->textarea->$_SESSION['lang'] ?></span>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<input ng-model="long.email" type="email" name="email" placeholder="<?php echo $diccionario->fields->mail->$_SESSION['lang'] ?>" required>
											<div ng-show="form_method.email.$touched && !form_method.$pristine">
												<span ng-show="form_method.email.$error.required" class="alert"><?php echo $diccionario->alerts->mail->$_SESSION['lang'] ?></span>
												<span ng-show="form_method.email.$error.email" class="alert"><?php echo $diccionario->alerts->mailpattern->$_SESSION['lang'] ?></span>
											</div>
											<input ng-model="long.telf" type="text" ng-pattern="/^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/" name="telf" placeholder="<?php echo $diccionario->fields->telf->$_SESSION['lang'] ?>" required>
											<div ng-show="form_method.telf.$touched && !form_method.$pristine">
												<span ng-show="form_method.telf.$error.required" class="alert"><?php echo $diccionario->alerts->telf->$_SESSION['lang'] ?></span>
							  					<span ng-show="form_method.telf.$error.pattern" class="alert"><?php echo $diccionario->alerts->telfpattern->$_SESSION['lang'] ?></span>
											</div>
											<div class="canal">
												<small><?php echo $diccionario->fields->deliver->$_SESSION['lang'] ?></small><br>
												<span class="form_check"><input ng-model="long.canal" type="radio" name="canal" value="email" required> <small><?php echo $diccionario->fields->mail->$_SESSION['lang'] ?></small>
												<input ng-model="long.canal" type="radio" name="canal" value="telf"> <small><?php echo $diccionario->fields->telf->$_SESSION['lang'] ?></small></span>
												<div ng-show="form_method.canal.$touched && !form_method.$pristine">
													<span ng-show="form_method.canal.$error.required" class="alert"><?php echo $diccionario->alerts->deliver->$_SESSION['lang'] ?></span>
												</div>
											</div>
											<span class="form_check"><input ng-model="long.politica" type="checkbox" name="politica" required> <small><a href='/<?php echo $_SESSION['lang'] ?>/legal'><?php echo $diccionario->fields->privacity->$_SESSION['lang'] ?></a></small></span>
											<input class="boton" type="submit" ng-click="sendMailMasInfo()" value="<?php echo $diccionario->fields->button->$_SESSION['lang'] ?>" ng-disabled="!form_method.$valid">
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>