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
			<div class="col-sm-6 padding20">
				<img title="{{contenido.content.alt[lang]}}" src="/img/{{contenido.content.img}}" alt="{{contenido.content.alt[lang]}}">
			</div>
			<div class="col-sm-6 padding20">
				<p ng-repeat="text in contenido.content.text" ng-bind-html="interpretar(text[lang])"></p>
			</div>
		</div>
	</div>
</div>