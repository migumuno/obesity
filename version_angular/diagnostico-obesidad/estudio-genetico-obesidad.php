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
			</div>
			<div class="col-sm-6 padding20">
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
			</div>
			<div class="col-xs-12">
				<span ng-if="esArray(contenido.content.text)" ng-repeat="text in contenido.content.text">
					<p ng-bind-html="interpretar(text[lang])"></p>
					<span ng-if="text.ul != undefined">
						<ul class="bigli">
							<span ng-if="text.ul.li != undefined">
								<li ng-repeat="li in text.ul.li">
									<span ng-bind-html="interpretar(li[lang])"></span>
									<span ng-if="li.ul != undefined">
										<ul>
											<li ng-repeat="li_sub in li.ul.li">
												<span ng-bind-html="interpretar(li_sub[lang])"></span>
											</li>
										</ul>
									</span>
								</li>
							</span>
						</ul>
					</span>
				</span>
				<span ng-if="!esArray(contenido.content.text)">
					<p ng-bind-html="interpretar(contenido.content.text[lang])"></p>
					<span ng-if="contenido.content.text.ul != undefined">
						<ul class="bigli">
							<span ng-if="text.ul.li != undefined">
								<li ng-repeat="li in contenido.content.text.ul.li">
									<span ng-bind-html="interpretar(li[lang])"></span>
									<span ng-if="li.ul != undefined">
										<ul>
											<li ng-repeat="li_sub in li.ul.li">
												<span ng-bind-html="interpretar(li_sub[lang])"></span>
											</li>
										</ul>
									</span>
								</li>
							</span>
						</ul>
					</span>
				</span>
				<span ng-if="contenido.content.list != undefined">
					<div ng-if="contenido.content.list.left != undefined" class="col-sm-6">
						<ul class="bigli">
							<li ng-repeat="li in contenido.content.list.left.ul.li">
								<span ng-bind-html="interpretar(li[lang])"></span>
								<span ng-if="li.ul != undefined">
									<ul>
										<li ng-repeat="li_sub in li.ul.li">
											<span ng-bind-html="interpretar(li_sub[lang])"></span>
										</li>
									</ul>
								</span>
							</li>
						</ul>
					</div>
				</span>
				<span ng-if="contenido.content.list != undefined">
					<div ng-if="contenido.content.list.right != undefined" class="col-sm-6">
						<ul class="bigli">
							<li ng-repeat="li in contenido.content.list.right.ul.li">
								<span ng-bind-html="interpretar(li[lang])"></span>
								<span ng-if="li.ul != undefined">
									<ul>
										<li ng-repeat="li_sub in li.ul.li">
											<span ng-bind-html="interpretar(li_sub[lang])"></span>
										</li>
									</ul>
								</span>
							</li>
						</ul>
					</div>
				</span>
			</div>
		</div>
	</div>
</div>