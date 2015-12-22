<div class="metodo">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 padding20">
				<p ng-repeat="text in contenido.content.left.text" ng-bind-html="interpretar(text[lang])"></p>
			</div>
			<div class="col-sm-6 padding20">
				<p ng-repeat="text in contenido.content.right.text" ng-bind-html="interpretar(text[lang])"></p>
			</div>
		</div>
	</div>
</div>
<div class="caracteristicas_metodo">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="col-md-4 col-sm-6 caracteristica_metodo" ng-repeat="card in contenido.content.cards.card">
					<div class="titulo_caracteristica">{{card.title[lang]}}</div>
					<div class="contenido_caracteristica">
						<img title="{{card.alt[lang]}}" src="/img/{{card.img}}" alt="{{card.alt[lang]}}">
						<div class="txt_caracteristica">
							<p ng-bind-html="interpretar(card.text[lang])"></p>
						</div>
						<div class="boton_diagnostico"><a href="/<?php echo $_SESSION['lang'] ?>{{card.link[lang]}}"><button class="boton">{{dictionary.buttons.more_info[lang]}}</button></a></div>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 caracteristica_metodo">
					<div class="contenido_info_diagnostico">
						<div class="titulo_info_diagnostico">{{dictionary.fields.request[lang]}}</div>
						<div class="form">
							<form name="form_method" method="get" action="" novalidate>
								<div class="row">
									<div class="col-xs-12 form-diagnostico">
										<div class="col-md-12 col-sm-12">
											<input ng-model="nombre" type="text" name="nombre" placeholder="{{dictionary.fields.name[lang]}}" required>
											<div ng-show="form_method.nombre.$touched">
												<span ng-show="form_method.nombre.$error.required" class="alert">{{dictionary.alerts.name[lang]}}</span>
											</div>
											<textarea ng-model="message" name="message" rows="4" placeholder="{{dictionary.fields.textarea[lang]}}" required></textarea>
											<div ng-show="form_method.message.$touched">
												<span ng-show="form_method.message.$error.required" class="alert">{{dictionary.alerts.textarea[lang]}}</span>
											</div>
										</div>
										<div class="col-md-12 col-sm-12">
											<input ng-model="email" type="email" name="email" placeholder="{{dictionary.fields.mail[lang]}}" required>
											<div ng-show="form_method.email.$touched">
												<span ng-show="form_method.email.$error.required" class="alert">{{dictionary.alerts.mail[lang]}}</span>
												<span ng-show="form_method.email.$error.email" class="alert">{{dictionary.alerts.mailpattern[lang]}}</span>
											</div>
											<input ng-model="telf" type="text" ng-pattern="/^((\+?34([ \t|\-])?)?[9|6|7]((\d{1}([ \t|\-])?[0-9]{3})|(\d{2}([ \t|\-])?[0-9]{2}))([ \t|\-])?[0-9]{2}([ \t|\-])?[0-9]{2})$/" name="telf" placeholder="{{dictionary.fields.telf[lang]}}" required>
											<div ng-show="form_method.telf.$touched">
												<span ng-show="form_method.telf.$error.required" class="alert">{{dictionary.alerts.telf[lang]}}</span>
							  					<span ng-show="form_method.telf.$error.pattern" class="alert">{{dictionary.alerts.telfpattern[lang]}}</span>
											</div>
											<div class="canal">
												<small>{{dictionary.fields.deliver[lang]}}</small><br>
												<span class="form_check"><input ng-model="canal" type="radio" name="canal" value="email" required> <small>{{dictionary.fields.mail[lang]}}</small>
												<input ng-model="canal" type="radio" name="canal" value="telf"> <small>{{dictionary.fields.telf[lang]}}</small></span>
												<div ng-show="form_method.canal.$touched">
													<span ng-show="form_method.canal.$error.required" class="alert">{{dictionary.alerts.deliver[lang]}}</span>
												</div>
											</div>
											<span class="form_check"><input ng-model="politica" type="checkbox" name="politica" required> <small>{{dictionary.fields.privacity[lang]}}</small></span>
											<div ng-show="form_method.politica.$touched">
												<span ng-show="form_method.politica.$error.required" class="alert">{{dictionary.alerts.privacity[lang]}}</span>
											</div>
											<input class="boton" type="submit" value="enviar consulta" ng-disabled="!form_method.$valid">
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