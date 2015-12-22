<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>
<?php $xml = 'clinica-obesidad'; ?>

<div class="clinica_obesidad">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="titulo titulo_caracteristica"><?php echo $diccionario->texts->send_message->$_SESSION['lang'] ?></div>
				<div class="contenido_contacto">
					<div class="contact_txt">
						<?php 
						$texto = $xml_code->content->text;
						if (count($texto) > 0) {
							for ($i=0; $i<count($texto); $i++) {
								echo '<p>'.traducirStringXml($texto[$i]->$_SESSION['lang']).'</p>';
							}
						} else 
							echo '<p>'.traducirStringXml($texto->$_SESSION['lang']).'</p>';
						?>
					</div>
					<div class="form">
						<form name="clinica_obesidad" novalidate>
							<input type="text" name="name" ng-model="contact.name" placeholder="<?php echo $diccionario->fields->name->$_SESSION['lang'] ?>*" required>
							<div ng-show="clinica_obesidad.name.$touched && !clinica_obesidad.$pristine">
								<span ng-show="clinica_obesidad.name.$error.required" class="alert"><?php echo $diccionario->alerts->name->$_SESSION['lang'] ?>/span>
							</div>
							<input ng-model="contact.email" type="email" name="email" placeholder="<?php echo $diccionario->fields->mail->$_SESSION['lang'] ?>*" required>
							<div ng-show="clinica_obesidad.email.$touched && !clinica_obesidad.$pristine">
								<span ng-show="clinica_obesidad.email.$error.required" class="alert"><?php echo $diccionario->alerts->mail->$_SESSION['lang'] ?></span>
								<span ng-show="clinica_obesidad.email.$error.email" class="alert"><?php echo $diccionario->alerts->mailpattern->$_SESSION['lang'] ?></span>
							</div>
							<input ng-model="contact.telf" type="text" ng-pattern="/^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/" name="telf" placeholder="<?php echo $diccionario->fields->telf->$_SESSION['lang'] ?>*" required>
							<div ng-show="clinica_obesidad.telf.$touched && !clinica_obesidad.$pristine">
								<span ng-show="clinica_obesidad.telf.$error.required" class="alert"><?php echo $diccionario->alerts->telf->$_SESSION['lang'] ?></span>
			  					<span ng-show="clinica_obesidad.telf.$error.pattern" class="alert"><?php echo $diccionario->alerts->telfpattern->$_SESSION['lang'] ?></span>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<label><?php echo $diccionario->texts->country_select->$_SESSION['lang'] ?>*:<br>
										<select ng-model="contact.country" ng-options="country.name for country in countries[lang].country track by country.name" required></select>
									</label>
								</div>
								<div class="col-sm-6">
									<label><?php echo $diccionario->texts->interest_select->$_SESSION['lang'] ?>*:<br>
										<select ng-model="contact.interest" ng-options="option.name[lang] for option in contenido.content.interest.option track by option.value[lang]" required></select>
									</label>
								</div>
							</div>
							<div class="canal">
								<small><?php echo $diccionario->fields->deliver->$_SESSION['lang'] ?>*</small><br>
								<span class="form_check"><input ng-model="contact.canal" type="radio" name="canal" value="email" required> <small><?php echo $diccionario->fields->mail->$_SESSION['lang'] ?></small>
								<input ng-model="contact.canal" type="radio" name="canal" value="telf"> <small><?php echo $diccionario->fields->telf->$_SESSION['lang'] ?></small></span>
								<div ng-show="clinica_obesidad.canal.$touched && !clinica_obesidad.$pristine">
									<span ng-show="clinica_obesidad.canal.$error.required" class="alert"><?php echo $diccionario->alerts->deliver->$_SESSION['lang'] ?></span>
								</div>
							</div>
							<textarea ng-model="contact.message" name="message" rows="11" placeholder="<?php echo $diccionario->fields->textarea->$_SESSION['lang'] ?>*" required></textarea>
							<div ng-show="clinica_obesidad.message.$touched && !clinica_obesidad.$pristine">
								<span ng-show="clinica_obesidad.message.$error.required" class="alert"><?php echo $diccionario->alerts->textarea->$_SESSION['lang'] ?></span>
							</div>
							<span class="form_check"><input ng-model="contact.politica" type="checkbox" name="politica" required> <small><a href='/<?php echo $_SESSION['lang'] ?>/legal'><?php echo $diccionario->fields->privacity->$_SESSION['lang'] ?></a></small></span>
							<br><small>* <?php echo $diccionario->texts->required_fields->$_SESSION['lang'] ?></small>
							<input class="boton" type="submit" ng-click="sendMailContact()" value="<?php echo $diccionario->fields->button->$_SESSION['lang'] ?>" ng-disabled="!clinica_obesidad.$valid">
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="titulo titulo_caracteristica"><?php echo $diccionario->texts->info_contact->$_SESSION['lang'] ?></div>
				<div class="item_contact">
					<div class="contact_card">
						<span class="row">
							<span class="col-xs-12"><img title="dirección" alt="dirección" src="/img/icons/pin.png"> <span class="info_contact">Paseo de la Habana, 63 28036 Madrid</span></span>
						</span>
					</div>
					<div class="contact_card">
						<span class="row">
							<span class="col-xs-12"><img title="<?php echo $pie->img->phone->alt->$_SESSION['lang'] ?>" alt="<?php echo $pie->img->phone->alt->$_SESSION['lang'] ?>" src="/img/icons/<?php echo $pie->img->phone->link ?>"> <span class="info_contact"><a href="tel:+34900104050" target="_blank">+34 900 10 40 50</a><br></span></span>
						</span>
					</div>
					<div class="contact_card">
						<span class="row">
							<span class="col-xs-12">
								<script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
								<div id="SkypeButton_Call_ObesityHealthSpain_3">
								  <script type="text/javascript">
								    Skype.ui({
								      "name": "call",
								      "element": "SkypeButton_Call_ObesityHealthSpain_3",
								      "participants": ["ObesityHealthSpain"],
									   "imageColor": "blue",
								      "imageSize": 24
								    });
								  </script>
								</div>
							</span>
						</span>
					</div>
					<div class="contact_card">
						<span class="row">
							<span class="col-xs-12"><img title="<?php echo $pie->img->mail->alt->$_SESSION['lang'] ?>" alt="<?php echo $pie->img->mail->alt->$_SESSION['lang'] ?>" src="/img/icons/<?php echo $pie->img->mail->link ?>"> <span class="info_contact"><a href="mailto:patients@obesity.es">patients@obesity.es</a></span></span>
						</span>
					</div>
					<!-- <div class="contact_card">
						<span class="row">
							<span class="col-xs-12">SIGUENOS EN: <img title="<?php echo $pie->img->facebook->alt->$_SESSION['lang'] ?>" alt="<?php echo $pie->img->facebook->alt->$_SESSION['lang'] ?>" src="/img/icons/facebook_footer.png"> <img title="<?php echo $pie->img->twitter->alt->$_SESSION['lang'] ?>" alt="<?php echo $pie->img->twitter->alt->$_SESSION['lang'] ?>" src="/img/icons/twitter_footer.png"> <img title="<?php echo $pie->img->rss->alt->$_SESSION['lang'] ?>" alt="<?php echo $pie->img->rss->alt->$_SESSION['lang'] ?>" src="/img/icons/blog_footer.png"> <img alt="<?php echo $pie->img->youtube->alt->$_SESSION['lang'] ?>" alt="<?php echo $pie->img->youtube->alt->$_SESSION['lang'] ?>" src="/img/icons/youtube_footer.png"></span>
						</span>
					</div> -->
				</div>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3035.943567150297!2d-3.6837293987023316!3d40.45438598574676!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd42291fe04e7b67%3A0x9db0bcffd61b4b35!2sPaseo+de+la+Habana%2C+63%2C+28036+Madrid!5e0!3m2!1ses!2ses!4v1433755856051" width="100%" height="300" frameborder="0" style="border:0"></iframe>
			</div>
		</div>
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>