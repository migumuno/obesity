<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>
<?php $xml = 'pacientes-internacionales'; ?>

<div class="metodo">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 padding20">
				<?php 
				for ($i=0; $i<count($xml_code->content->text); $i++) {
					echo '<p>'.traducirStringXml($xml_code->content->text[$i]->$_SESSION['lang']).'</p>';
				}
				?>
			</div>
			<div class="col-sm-6 padding20">
				<div class="titulo titulo_caracteristica"><?php echo $diccionario->texts->patient_care->$_SESSION['lang'] ?></div>
				<div class="form">
					<form name="mas_info" novalidate>
						<input type="text" name="name" ng-model="long.name" placeholder="<?php echo $diccionario->fields->name->$_SESSION['lang'] ?>*" required>
						<div ng-show="mas_info.name.$touched && !mas_info.$pristine">
							<span ng-show="mas_info.name.$error.required" class="alert"><?php echo $diccionario->alerts->name->$_SESSION['lang'] ?></span>
						</div>
						<input ng-model="long.email" type="email" name="email" placeholder="<?php echo $diccionario->fields->mail->$_SESSION['lang'] ?>*" required>
						<div ng-show="mas_info.email.$touched && !mas_info.$pristine">
							<span ng-show="mas_info.email.$error.required" class="alert"><?php echo $diccionario->alerts->mail->$_SESSION['lang'] ?></span>
							<span ng-show="mas_info.email.$error.email" class="alert"><?php echo $diccionario->alerts->mailpattern->$_SESSION['lang'] ?></span>
						</div>
						<input ng-model="long.telf" type="text" ng-pattern="/^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/" name="telf" placeholder="<?php echo $diccionario->fields->telf->$_SESSION['lang'] ?>*" required>
						<div ng-show="mas_info.telf.$touched && !mas_info.$pristine">
							<span ng-show="mas_info.telf.$error.required" class="alert"><?php echo $diccionario->alerts->telf->$_SESSION['lang'] ?></span>
		  					<span ng-show="mas_info.telf.$error.pattern" class="alert"><?php echo $diccionario->alerts->telfpattern->$_SESSION['lang'] ?></span>
						</div>
						<div class="canal">
							<small><?php echo $diccionario->fields->deliver->$_SESSION['lang'] ?>*</small><br>
							<span class="form_check"><input ng-model="long.canal" type="radio" name="canal" value="email" required> <small><?php echo $diccionario->fields->mail->$_SESSION['lang'] ?></small>
							<input ng-model="long.canal" type="radio" name="canal" value="telf"> <small><?php echo $diccionario->fields->telf->$_SESSION['lang'] ?></small></span>
							<div ng-show="mas_info.canal.$touched && !mas_info.$pristine">
								<span ng-show="mas_info.canal.$error.required" class="alert"><?php echo $diccionario->alerts->deliver->$_SESSION['lang'] ?></span>
							</div>
						</div>
						<textarea ng-model="long.message" name="message" rows="11" placeholder="<?php echo $diccionario->fields->textarea->$_SESSION['lang'] ?>*" required></textarea>
						<div ng-show="mas_info.message.$touched && !mas_info.$pristine">
							<span ng-show="mas_info.message.$error.required" class="alert"><?php echo $diccionario->alerts->textarea->$_SESSION['lang'] ?></span>
						</div>
						<span class="form_check"><input ng-model="long.politica" type="checkbox" name="politica" required> <small><a href='/<?php echo $_SESSION['lang'] ?>/legal'><?php echo $diccionario->fields->privacity->$_SESSION['lang'] ?></a></small></span>
						<br><small>* <?php echo $diccionario->texts->required_fields->$_SESSION['lang'] ?></small>
						<input class="boton" type="submit" ng-click="sendMailMasInfo()" value="<?php echo $diccionario->fields->button->$_SESSION['lang'] ?>" ng-disabled="!mas_info.$valid">
					</form>
				</div>
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
					echo '
					<div class="col-md-3 col-sm-6 caracteristica_metodo">
						<div class="contenido_caracteristica">
							<img title="'.$tarjetas[$i]->alt->$_SESSION['lang'].'" src="/img/'.$tarjetas[$i]->img->$_SESSION['lang'].'" alt="'.$tarjetas[$i]->alt->$_SESSION['lang'].'">
							<div class="txt_paso">
								<p>'.traducirStringXml($tarjetas[$i]->text->$_SESSION['lang']).'</p>
							</div>
						</div>
					</div>
					';
				}
				?>
			</div>
		</div>
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>