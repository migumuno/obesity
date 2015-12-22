<div class="metodo">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 padding20">
				<img title="<?php echo $xml_code->content->alt->$_SESSION['lang'] ?>" src="/img/<?php echo $xml_code->content->img ?>" alt="<?php echo $xml_code->content->alt->$_SESSION['lang'] ?>">
			</div>
			<div class="col-sm-6 padding20">
				<?php 
				for ($i=0; $i<count($xml_code->content->text); $i++) {
					echo '<p>'.$xml_code->content->text[$i]->$_SESSION['lang'].'</p>';
				}
				?>
			</div>
		</div>
	</div>
</div>
<div class="caracteristicas_metodo">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php 
				$tarjetas = $xml_code->content->cards->card;
				for ($i=0; $i<count($tarjetas); $i++) {
					echo '<div class="col-md-4 col-sm-6 caracteristica_metodo">';
						echo '<div class="titulo_caracteristica">'.$tarjetas[$i]->title->$_SESSION['lang'].'</div>';
						echo '
						<div class="contenido_caracteristica">
							<img title="'.$tarjetas[$i]->alt->$_SESSION['lang'].'" src="/img/'.$tarjetas[$i]->img.'" alt="'.$tarjetas[$i]->alt->$_SESSION['lang'].'">
							<div class="txt_caracteristica">
								<p>'.traducirStringXml($tarjetas[$i]->text->$_SESSION['lang']).'</p>
							</div>
							<div class="boton_diagnostico"><a href="/'.$_SESSION['lang'].$tarjetas[$i]->link->$_SESSION['lang'].'"><button class="boton">'.$diccionario->buttons->more_info->$_SESSION['lang'].'</button></a></div>
						</div>
						';
					echo '</div>';
				}
				?>
				<div class="col-md-4 col-sm-6 caracteristica_metodo">
					<div class="contenido_info_diagnostico">
						<div class="titulo_info_diagnostico"><?php echo $diccionario->fields->request->$_SESSION['lang'] ?></div>
						<div class="form">
							<form name="form_method" method="get" action="" novalidate>
								<div class="row">
									<div class="col-xs-12 form-diagnostico">
										<div class="col-md-12 col-sm-12">
											<input ng-model="nombre" type="text" name="nombre" placeholder="<?php echo $diccionario->fields->name->$_SESSION['lang'] ?>" required>
											<div ng-show="form_method.nombre.$touched">
												<span ng-show="form_method.nombre.$error.required" class="alert"><?php echo $diccionario->alerts->name->$_SESSION['lang'] ?></span>
											</div>
											<textarea ng-model="message" name="message" rows="4" placeholder="<?php echo $diccionario->fields->textarea->$_SESSION['lang'] ?>" required></textarea>
											<div ng-show="form_method.message.$touched">
												<span ng-show="form_method.message.$error.required" class="alert"><?php echo $diccionario->alerts->textarea->$_SESSION['lang'] ?></span>
											</div>
										</div>
										<div class="col-md-12 col-sm-12">
											<input ng-model="email" type="email" name="email" placeholder="<?php echo $diccionario->fields->mail->$_SESSION['lang'] ?>" required>
											<div ng-show="form_method.email.$touched">
												<span ng-show="form_method.email.$error.required" class="alert"><?php echo $diccionario->alerts->mail->$_SESSION['lang'] ?></span>
												<span ng-show="form_method.email.$error.email" class="alert"><?php echo $diccionario->alerts->mailpattern->$_SESSION['lang'] ?></span>
											</div>
											<input ng-model="telf" type="text" ng-pattern="/^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/" name="telf" placeholder="<?php echo $diccionario->fields->telf->$_SESSION['lang'] ?>" required>
											<div ng-show="form_method.telf.$touched">
												<span ng-show="form_method.telf.$error.required" class="alert"><?php echo $diccionario->alerts->telf->$_SESSION['lang'] ?></span>
							  					<span ng-show="form_method.telf.$error.pattern" class="alert"><?php echo $diccionario->alerts->telfpattern->$_SESSION['lang'] ?></span>
											</div>
											<div class="canal">
												<small><?php echo $diccionario->fields->deliver->$_SESSION['lang'] ?></small><br>
												<span class="form_check"><input ng-model="canal" type="radio" name="canal" value="email" required> <small><?php echo $diccionario->fields->mail->$_SESSION['lang'] ?></small>
												<input ng-model="canal" type="radio" name="canal" value="telf"> <small><?php echo $diccionario->fields->telf->$_SESSION['lang'] ?></small></span>
												<div ng-show="form_method.canal.$touched">
													<span ng-show="form_method.canal.$error.required" class="alert"><?php echo $diccionario->alerts->deliver->$_SESSION['lang'] ?></span>
												</div>
											</div>
											<span class="form_check"><input ng-model="politica" type="checkbox" name="politica" required> <small><a href='/legal'><?php echo $diccionario->fields->privacity->$_SESSION['lang'] ?></a></small></span>
											<div ng-show="form_method.politica.$touched">
												<span ng-show="form_method.politica.$error.required" class="alert"><?php echo $diccionario->alerts->privacity->$_SESSION['lang'] ?></span>
											</div>
											<input class="boton" type="submit" value="<?php echo $diccionario->fields->button->$_SESSION['lang'] ?>" ng-disabled="!form_method.$valid">
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