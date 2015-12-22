<div class="metodo">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 padding20">
				<img title="{{contenido.content.alt[lang]}}" src="/img/{{contenido.content.img}}" alt="{{contenido.content.alt[lang]}}">
			</div>
			<div class="col-sm-6 padding20">
				<span ng-repeat="text in contenido.content.text">
					<p ng-bind-html="interpretar(text[lang])"></p>
					<span ng-if="text.ul != undefined">
						<ul class="bigli">
							<span ng-if="text.ul.li != undefined">
								<li ng-repeat="li in text.ul.li">
									<span ng-bind-html="interpretar(li[lang])"></span>
								</li>
							</span>
						</ul>
					</span>
				</span>
			</div>
		</div>
	</div>
</div>
<div class="caracteristicas_metodo">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="col-md-3 col-sm-6 caracteristica_metodo" ng-repeat="card in contenido.content.cards.card">
					<div class="titulo_caracteristica">{{card.title[lang]}}</div>
					<div class="contenido_caracteristica">
						<img title="{{card.alt[lang]}}" src="/img/{{card.img}}" alt="{{card.alt[lang]}}">
						<div class="txt_nosotros">
							<span ng-if="esArray(card.text)">
								<p ng-repeat="txt in card.text" ng-bind-html="interpretar(txt[lang])"></p>
							</span>
							<span ng-if="!esArray(card.text)">
								<p ng-bind-html="interpretar(card.text[lang])"></p>
							</span>
						</div>
						<div class="boton_diagnostico"><a href="/<?php echo $_SESSION['lang'] ?>{{card.link[lang]}}"><button class="boton">{{dictionary.buttons.more_info[lang]}}</button></a></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>