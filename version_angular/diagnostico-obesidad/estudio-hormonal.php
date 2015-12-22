<div class="metodo">
	<div class="container">
		<span ng-if="contenido.breadcrumbs != undefined">
			<ol class="breadcrumb">
			  <li ng-if="contenido.breadcrumbs != undefined && esArray(contenido.breadcrumbs.item)" ng-repeat="li in contenido.breadcrumbs.item"><a href="/<?php echo $_SESSION['lang'] ?>{{li.link}}">{{li.name[lang]}}</a></li>
			  <li ng-if="contenido.breadcrumbs != undefined && !esArray(contenido.breadcrumbs.item)"><a href="/<?php echo $_SESSION['lang'] ?>{{contenido.breadcrumbs.item.link[lang]}}">{{contenido.breadcrumbs.item.name[lang]}}</a></li>
			  <li class="active">{{contenido.breadcrumbs.active.name[lang]}}</li>
			</ol>
		</span>
		<div class="row">
			<div class="col-sm-12">
				<p ng-repeat="text in contenido.content.text" ng-bind-html="interpretar(text[lang])"></p>
			</div>
		</div>
	</div>
</div>
<div class="caracteristicas_metodo">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="col-sm-6 caracteristica_metodo" ng-repeat="card in contenido.content.cards.card">
					<div class="titulo_caracteristica">{{card.title[lang]}}</div>
					<div class="contenido_caracteristica">
						<div class="txt_caracteristica hormonal">
							<p ng-bind-html="interpretar(card.text[lang])"></p>
							<span ng-if="card.text.ul != undefined">
								<ul>
									<li ng-repeat="li in card.text.ul.li" ng-bind-html="interpretar(li[lang])"></li>
								</ul>
							</span>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>