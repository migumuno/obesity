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
									<span ng-if="li.link != undefined"><a href="/{{li.link}}" ng-bind-html="interpretar(li[lang])"></a></span>
									<span ng-if="li.link == undefined" ng-bind-html="interpretar(li[lang])"></span>
								</li>
							</span>
						</ul>
					</span>
				</span>
			</div>
		</div>
	</div>
</div>