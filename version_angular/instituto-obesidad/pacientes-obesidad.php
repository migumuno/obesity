<div class="metodo">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<span ng-if="esArray(contenido.content.text)">
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
				</span>
				<span ng-if="!esArray(contenido.content.text)">
					<p ng-bind-html="interpretar(contenido.content.text[lang])"></p>
					<span ng-if="contenido.content.text.ul != undefined">
						<ul class="bigli">
							<span ng-if="contenido.content.text.ul.li != undefined">
								<li ng-repeat="li in contenido.content.text.ul.li">
									<span ng-bind-html="interpretar(li[lang])"></span>
								</li>
							</span>
						</ul>
					</span>
				</span>
			</div>
			<div class="col-sm-6 padding20">
				<span ng-if="esArray(contenido.content.left.text)">
					<span ng-repeat="text in contenido.content.left.text">
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
				</span>
				<span ng-if="!esArray(contenido.content.left.text)">
					<p ng-bind-html="interpretar(contenido.content.left.text[lang])"></p>
					<span ng-if="contenido.content.left.text.ul != undefined">
						<ul class="bigli">
							<span ng-if="contenido.content.left.text.ul.li != undefined">
								<li ng-repeat="li in contenido.content.left.text.ul.li">
									<span ng-bind-html="interpretar(li[lang])"></span>
								</li>
							</span>
						</ul>
					</span>
				</span>
			</div>
			<div class="col-sm-6 padding20">
				<span ng-if="esArray(contenido.content.right.text)">
					<span ng-repeat="text in contenido.content.right.text">
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
				</span>
				<span ng-if="!esArray(contenido.content.right.text)">
					<p ng-bind-html="interpretar(contenido.content.right.text[lang])"></p>
					<span ng-if="contenido.content.right.text.ul != undefined">
						<ul class="bigli">
							<span ng-if="contenido.content.right.text.ul.li != undefined">
								<li ng-repeat="li in contenido.content.right.text.ul.li">
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