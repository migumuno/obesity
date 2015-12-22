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
				<img title="{{contenido.content.img.alt[lang]}}" src="/img/{{contenido.content.img.name}}" alt="{{contenido.content.img.alt[lang]}}">
				<span ng-if="(contenido.content.description != undefined) && (contenido.content.description.text != undefined)">	
					<span ng-if="esArray(contenido.content.description.text)">
						<div class="descripcion">
							<span ng-repeat="txt in contenido.content.description.text">
								<p ng-bind-html="interpretar(txt[lang])"></p>
								<span ng-if="txt.ul != undefined">
									<ul>
										<span ng-if="txt.ul.li != undefined">
											<li ng-repeat="li in txt.ul.li">
												<span ng-bind-html="interpretar(li[lang])"></span>
												<span ng-if="li.ul != undefined">
													<ul>
														<span ng-if="li.ul.li != undefined">
															<li ng-repeat="subli in li.ul.li" ng-bind-html="interpretar(subli[lang])"></li>
														</span>
													</ul>
												</span>
											</li>
										</span>
									</ul>
								</span>
							</span>
						</div>
					</span>
					<span ng-if="!esArray(contenido.content.description.text)">
						<p ng-bind-html="interpretar(contenido.content.description.text[lang])"></p>
						<span ng-if="contenido.content.description.text.ul != undefined">
							<ul>
								<span ng-if="contenido.content.description.text.ul.li != undefined">
									<li ng-repeat="li in contenido.content.description.text.ul.li">
										<span ng-bind-html="interpretar(li[lang])"></span>
										<span ng-if="li.ul != undefined">
											<ul>
												<span ng-if="li.ul.li != undefined">
													<li ng-repeat="subli in li.ul.li" ng-bind-html="interpretar(subli[lang])"></li>
												</span>
											</ul>
										</span>
									</li>
								</span>
							</ul>
						</span>
					</span>
				</span>
			</div>
			<div class="col-sm-6 padding20">
				<div ng-if="contenido.content.treatment.title != undefined" class="titulo_metodo">{{contenido.content.treatment.title[lang]}}</div>
				<span ng-if="contenido.content.treatment.duration != undefined">	
					<div class="subtitulo_metodo">{{dictionary.texts.duration[lang]}}:</div>
					<p>{{contenido.content.treatment.duration[lang]}}</p>
				</span>
				<div class="subtitulo_metodo">{{dictionary.texts.include[lang]}}:</div>
				<span ng-repeat="text in contenido.content.treatment.text">
					<p ng-bind-html="interpretar(text[lang])"></p>
					<span ng-if="text.ul != undefined">
						<ul>
							<span ng-if="text.ul.li != undefined">
								<li ng-repeat="li in text.ul.li">
									<span ng-bind-html="interpretar(li[lang])"></span>
									<span ng-if="li.ul != undefined">
										<ul>
											<span ng-if="li.ul.li != undefined">
												<li ng-repeat="subli in li.ul.li" ng-bind-html="interpretar(subli[lang])"></li>
											</span>
										</ul>
									</span>
								</li>
							</span>
						</ul>
					</span>
				</span>
			</div>
		</div>
	</div>
</div>
<div ng-if="contenido.content.cards != undefined" class="caracteristicas_metodo">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="col-md-3 col-sm-6 caracteristica_metodo" ng-repeat="card in contenido.content.cards.item">
					<div class="titulo_caracteristica">{{card.title[lang]}}</div>
					<div class="contenido_caracteristica">
						<div class="img_caracteristica"><img title="{{card.alt[lang]}}" src="/img/{{card.img}}" alt="{{card.alt[lang]}}"></div>
						<div  ng-class="{'txt_caracteristica_metodo':$index < 4, 'txt_caracteristica_metodo_min': $index >= 4}">
							<span ng-if="esArray(card.text)">
								<p ng-repeat="txt in card.text" ng-bind-html="interpretar(txt[lang])"></p>
							</span>
							<span ng-if="!esArray(card.text)">
								<p ng-bind-html="interpretar(card.text[lang])"></p>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="info_metodo">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="col-md-6 resultados">
					<div class="contenido_info_metodo">
						<div ng-if="contenido.content.results.title != undefined" class="titulo_info_metodo">{{contenido.content.results.title[lang]}}</div>
						<span ng-if="esArray(contenido.content.results.text)">
							<p ng-repeat="txt in contenido.content.results.text" ng-bind-html="interpretar(txt[lang])"></p>
						</span>
						<span ng-if="!esArray(contenido.content.results.text)">
							<p ng-bind-html="interpretar(contenido.content.results.text[lang])"></p>
						</span>
					</div>
				</div>
				<div class="col-md-6 solicitud">
					<div class="contenido_info_metodo">
						<div class="titulo_info_metodo">{{contenido.content.info.title[lang]}}</div>
						<div class="form">
							<form name="form_method" novalidate>
								<div class="row">
									<div class="col-xs-12">
										<div class="col-md-6 col-sm-12">
											<input ng-model="long.name" type="text" name="nombre" placeholder="{{dictionary.fields.name[lang]}}" required>
											<div ng-show="form_method.nombre.$touched && !form_method.$pristine">
												<span ng-show="form_method.nombre.$error.required" class="alert">{{dictionary.alerts.name[lang]}}</span>
											</div>
											<textarea ng-model="long.message" name="message" rows="7" placeholder="{{dictionary.fields.textarea[lang]}}" required></textarea>
											<div ng-show="form_method.message.$touched && !form_method.$pristine">
												<span ng-show="form_method.message.$error.required" class="alert">{{dictionary.alerts.textarea[lang]}}</span>
											</div>
										</div>
										<div class="col-md-6 col-sm-12">
											<input ng-model="long.email" type="email" name="email" placeholder="{{dictionary.fields.mail[lang]}}" required>
											<div ng-show="form_method.email.$touched && !form_method.$pristine">
												<span ng-show="form_method.email.$error.required" class="alert">{{dictionary.alerts.mail[lang]}}</span>
												<span ng-show="form_method.email.$error.email" class="alert">{{dictionary.alerts.mail[lang]}}</span>
											</div>
											<input ng-model="long.telf" type="text" ng-pattern="/^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/" name="telf" placeholder="{{dictionary.fields.telf[lang]}}" required>
											<div ng-show="form_method.telf.$touched && !form_method.$pristine">
												<span ng-show="form_method.telf.$error.required" class="alert">{{dictionary.alerts.telf[lang]}}</span>
							  					<span ng-show="form_method.telf.$error.pattern" class="alert">{{dictionary.alerts.telfpattern[lang]}}</span>
											</div>
											<div class="canal">
												<small>{{dictionary.fields.deliver[lang]}}</small><br>
												<span class="form_check"><input ng-model="long.canal" type="radio" name="canal" value="email" required> <small>{{dictionary.fields.mail[lang]}}</small>
												<input ng-model="long.canal" type="radio" name="canal" value="telf"> <small>{{dictionary.fields.telf[lang]}}</small></span>
												<div ng-show="form_method.canal.$touched && !form_method.$pristine">
													<span ng-show="form_method.canal.$error.required" class="alert">{{dictionary.alerts.deliver[lang]}}</span>
												</div>
											</div>
											<span class="form_check"><input ng-model="long.politica" type="checkbox" name="politica" required> <small><a href='/<?php echo $_SESSION['lang'] ?>/legal'>{{dictionary.fields.privacity[lang]}}</a></small></span>
											<input class="boton" type="submit" ng-click="sendMailMasInfo()" value="{{dictionary.fields.button[lang]}}" ng-disabled="!form_method.$valid">
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