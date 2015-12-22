<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>
<?php $xml = 'clinica-obesidad'; ?>

<div class="clinica_obesidad">
	<div class="container">
		<div class="row">
			<div class="col-sm-6">
				<div class="titulo titulo_caracteristica">{{dictionary.texts.send_message[lang]}}</div>
				<div class="contenido_contacto">
					<div class="contact_txt">
						<span ng-if="esArray(contenido.content.text)" ng-repeat="text in contenido.content.text"><p ng-bind-html="interpretar(text[lang])"></p></span>
						<span ng-if="!esArray(contenido.content.text)"><p ng-bind-html="interpretar(contenido.content.text[lang])"></p></span>
					</div>
					<div class="form">
						<form name="clinica_obesidad" novalidate>
							<input type="text" name="name" ng-model="contact.name" placeholder="{{dictionary.fields.name[lang]}}*" required>
							<div ng-show="clinica_obesidad.name.$touched && !clinica_obesidad.$pristine">
								<span ng-show="clinica_obesidad.name.$error.required" class="alert">{{dictionary.alerts.name[lang]}}</span>
							</div>
							<input ng-model="contact.email" type="email" name="email" placeholder="{{dictionary.fields.mail[lang]}}*" required>
							<div ng-show="clinica_obesidad.email.$touched && !clinica_obesidad.$pristine">
								<span ng-show="clinica_obesidad.email.$error.required" class="alert">{{dictionary.alerts.mail[lang]}}</span>
								<span ng-show="clinica_obesidad.email.$error.email" class="alert">{{dictionary.alerts.mail[lang]}}</span>
							</div>
							<input ng-model="contact.telf" type="text" ng-pattern="/^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/" name="telf" placeholder="{{dictionary.fields.telf[lang]}}*" required>
							<div ng-show="clinica_obesidad.telf.$touched && !clinica_obesidad.$pristine">
								<span ng-show="clinica_obesidad.telf.$error.required" class="alert">{{dictionary.alerts.telf[lang]}}</span>
			  					<span ng-show="clinica_obesidad.telf.$error.pattern" class="alert">{{dictionary.alerts.telfpattern[lang]}}</span>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<label>{{dictionary.texts.country_select[lang]}}*:<br>
										<select ng-model="contact.country" ng-options="country.name for country in countries[lang].country track by country.name" required></select>
									</label>
								</div>
								<div class="col-sm-6">
									<label>{{dictionary.texts.interest_select[lang]}}*:<br>
										<select ng-model="contact.interest" ng-options="option.name[lang] for option in contenido.content.interest.option track by option.value[lang]" required></select>
									</label>
								</div>
							</div>
							<div class="canal">
								<small>{{dictionary.fields.deliver[lang]}}*</small><br>
								<span class="form_check"><input ng-model="contact.canal" type="radio" name="canal" value="email" required> <small>{{dictionary.fields.mail[lang]}}</small>
								<input ng-model="contact.canal" type="radio" name="canal" value="telf"> <small>{{dictionary.fields.telf[lang]}}</small></span>
								<div ng-show="clinica_obesidad.canal.$touched && !clinica_obesidad.$pristine">
									<span ng-show="clinica_obesidad.canal.$error.required" class="alert">{{dictionary.alerts.deliver[lang]}}</span>
								</div>
							</div>
							<textarea ng-model="contact.message" name="message" rows="11" placeholder="{{dictionary.fields.textarea[lang]}}*" required></textarea>
							<div ng-show="clinica_obesidad.message.$touched && !clinica_obesidad.$pristine">
								<span ng-show="clinica_obesidad.message.$error.required" class="alert">{{dictionary.alerts.textarea[lang]}}</span>
							</div>
							<span class="form_check"><input ng-model="contact.politica" type="checkbox" name="politica" required> <small><a href='/<?php echo $_SESSION['lang'] ?>/legal'>{{dictionary.fields.privacity[lang]}}</a></small></span>
							<br><small>* {{dictionary.texts.required_fields[lang]}}</small>
							<input class="boton" type="submit" ng-click="sendMailContact()" value="{{dictionary.fields.button[lang]}}" ng-disabled="!clinica_obesidad.$valid">
						</form>
					</div>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="titulo titulo_caracteristica">{{dictionary.texts.info_contact[lang]}}</div>
				<div class="item_contact">
					<div class="contact_card">
						<span class="row">
							<span class="col-xs-12"><img title="dirección" alt="dirección" src="/img/icons/pin.png"> <span class="info_contact">Paseo de la Habana, 63 28036 Madrid</span></span>
						</span>
					</div>
					<div class="contact_card">
						<span class="row">
							<span class="col-xs-12"><img title="{{footer.img.phone.alt[lang]}}" alt="{{footer.img.phone.alt[lang]}}" src="/img/icons/{{footer.img.phone.link}}"> <span class="info_contact"><a href="tel:+34900104050" target="_blank">+34 900 10 40 50</a><br></span></span>
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
							<span class="col-xs-12"><img title="{{footer.img.mail.alt[lang]}}" alt="{{footer.img.mail.alt[lang]}}" src="/img/icons/{{footer.img.mail.link}}"> <span class="info_contact"><a href="mailto:patients@obesity.es">patients@obesity.es</a></span></span>
						</span>
					</div>
					<!-- <div class="contact_card">
						<span class="row">
							<span class="col-xs-12">SIGUENOS EN: <img title="{{footer.img.facebook.alt[lang]}}" alt="{{footer.img.facebook.alt[lang]}}" src="/img/icons/facebook_footer.png"> <img title="{{footer.img.twitter.alt[lang]}}" alt="{{footer.img.twitter.alt[lang]}}" src="/img/icons/twitter_footer.png"> <img title="{{footer.img.rss.alt[lang]}}" alt="{{footer.img.rss.alt[lang]}}" src="/img/icons/blog_footer.png"> <img alt="{{footer.img.youtube.alt[lang]}}" alt="{{footer.img.youtube.alt[lang]}}" src="/img/icons/youtube_footer.png"></span>
						</span>
					</div> -->
				</div>
				<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3035.943567150297!2d-3.6837293987023316!3d40.45438598574676!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd42291fe04e7b67%3A0x9db0bcffd61b4b35!2sPaseo+de+la+Habana%2C+63%2C+28036+Madrid!5e0!3m2!1ses!2ses!4v1433755856051" width="100%" height="300" frameborder="0" style="border:0"></iframe>
			</div>
		</div>
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>