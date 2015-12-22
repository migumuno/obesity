<div class="metodo">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 padding20">
				<p ng-repeat="text in contenido.content.left.text" ng-bind-html="interpretar(text[lang])"></p>
			</div>
			<div class="col-sm-6 padding20">
				<p ng-repeat="text in contenido.content.right.text" ng-bind-html="interpretar(text[lang])"></p>
			</div>
			<div class="col-xs-12 padding20">
				<p class="titulo_equipo">{{contenido.content.title[lang]}}</p>
			</div>
		</div>
	</div>
</div>
<div class="unidad" ng-repeat="unidad in contenido.unidad">
	<div class="titulo_caracteristica">{{unidad.title[lang]}}</div>
	<div class="txt_unidad">
		<div class="container">
			<div class="txt_unidad_center">
				<span ng-if="esArray(unidad.text)" ng-repeat="text in unidad.text">
					<p ng-bind-html="interpretar(text[lang])"></p>
					<span ng-if="text.left.ul != undefined">
						<ul>
							<li ng-if="esArray(text.left.ul.li)" ng-repeat="li in text.left.ul.li" ng-bind-html="interpretar(li[lang])"></li>
							<li ng-if="!esArray(text.left.ul.li)" ng-bind-html="interpretar(text.left.ul.li[lang])"></li>
						</ul>
					</span>
					<span ng-if="text.right.ul != undefined">
						<ul>
							<li ng-if="esArray(text.right.ul.li)" ng-repeat="li in text.right.ul.li" ng-bind-html="interpretar(li[lang])"></li>
							<li ng-if="!esArray(text.right.ul.li)" ng-bind-html="interpretar(text.right.ul.li[lang])"></li>
						</ul>
					</span>
				</span>
				<span ng-if="!esArray(unidad.text)">
					<p ng-bind-html="interpretar(unidad.text[lang])"></p>
					<div ng-if="unidad.text.left.ul != undefined || unidad.text.right.ul != undefined" class="row">
						<span ng-if="unidad.text.left.ul != undefined">
							<div class="col-sm-6">
								<ul>
									<li ng-if="esArray(unidad.text.left.ul.li)" ng-repeat="li in unidad.text.left.ul.li" ng-bind-html="interpretar(li[lang])"></li>
									<li ng-if="!esArray(unidad.text.left.ul.li)" ng-bind-html="interpretar(unidad.text.left.ul.li[lang])"></li>
								</ul>
							</div>
						</span>
						<span ng-if="unidad.text.right.ul != undefined">
							<div class="col-sm-6">
								<ul>
									<li ng-if="esArray(unidad.text.right.ul.li)" ng-repeat="li in unidad.text.right.ul.li" ng-bind-html="interpretar(li[lang])"></li>
									<li ng-if="!esArray(unidad.text.right.ul.li)" ng-bind-html="interpretar(unidad.text.right.ul.li[lang])"></li>
								</ul>
							</div>
						</span>
					</div>
				</span>
			</div>
			<div class="row" ng-if="unidad.left != undefined || unidad.right != undefined">
				<div class="col-xs-12">
					<div class="col-sm-6" ng-if="unidad.left != undefined">
						<span ng-if="esArray(unidad.left.text)" ng-repeat="text in unidad.left.text">
							<p ng-bind-html="interpretar(text[lang])"></p>
							<span ng-if="text.ul != undefined">
								<ul>	
									<li ng-if="esArray(text.ul.li)" ng-repeat="li in text.ul.li" ng-bind-html="interpretar(li[lang])"></li>
									<li ng-if="!esArray(text.ul.li)" ng-bind-html="interpretar(text.ul.li[lang])"></li>
								</ul>
							</span>
						</span>
						<span ng-if="!esArray(unidad.left.text)">
							<p ng-bind-html="interpretar(unidad.left.text[lang])"></p>
							<span ng-if="unidad.left.text.ul != undefined">
								<ul>
									<li ng-if="esArray(unidad.left.text.ul.li)" ng-repeat="li in unidad.left.text.ul.li" ng-bind-html="interpretar(li[lang])"></li>
									<li ng-if="!esArray(unidad.left.text.ul.li)" ng-bind-html="interpretar(unidad.left.text.ul.li[lang])"></li>
								</ul>
							</span>
						</span>
					</div>
					<div class="col-sm-6" ng-if="unidad.right != undefined">
						<span ng-if="esArray(unidad.right.text)" ng-repeat="text in unidad.right.text">
							<p ng-bind-html="interpretar(text[lang])"></p>
							<span ng-if="text.ul != undefined">
								<ul>	
									<li ng-if="esArray(text.ul.li)" ng-repeat="li in text.ul.li" ng-bind-html="interpretar(li[lang])"></li>
									<li ng-if="!esArray(text.ul.li)" ng-bind-html="interpretar(text.ul.li[lang])"></li>
								</ul>
							</span>
						</span>
						<span ng-if="!esArray(unidad.right.text)">
							<p ng-bind-html="interpretar(unidad.right.text[lang])"></p>
							<span ng-if="unidad.right.text.ul != undefined">
								<ul>
									<li ng-if="esArray(unidad.right.text.ul.li)" ng-repeat="li in unidad.right.text.ul.li" ng-bind-html="interpretar(li[lang])"></li>
									<li ng-if="!esArray(unidad.right.text.ul.li)" ng-bind-html="interpretar(unidad.right.text.ul.li[lang])"></li>
								</ul>
							</span>
						</span>
					</div>
				</div>
			</div>
			<div ng-if="unidad.subtext != undefined" class="txt_unidad_center">
				<span ng-if="esArray(unidad.subtext)" ng-repeat="text in unidad.subtext">
					<p ng-bind-html="interpretar(text[lang])"></p>
					<span ng-if="text.left.ul != undefined">
						<ul>
							<li ng-if="esArray(text.left.ul.li)" ng-repeat="li in text.left.ul.li" ng-bind-html="interpretar(li[lang])"></li>
							<li ng-if="!esArray(text.left.ul.li)" ng-bind-html="interpretar(text.left.ul.li[lang])"></li>
						</ul>
					</span>
					<span ng-if="text.right.ul != undefined">
						<ul>
							<li ng-if="esArray(text.right.ul.li)" ng-repeat="li in text.right.ul.li" ng-bind-html="interpretar(li[lang])"></li>
							<li ng-if="!esArray(text.right.ul.li)" ng-bind-html="interpretar(text.right.ul.li[lang])"></li>
						</ul>
					</span>
				</span>
				<span ng-if="!esArray(unidad.subtext)">
					<p ng-bind-html="interpretar(unidad.subtext[lang])"></p>
					<div ng-if="unidad.subtext.left.ul != undefined || unidad.subtext.right.ul != undefined" class="row">
						<span ng-if="unidad.subtext.left.ul != undefined">
							<div class="col-sm-6">
								<ul>
									<li ng-if="esArray(unidad.subtext.left.ul.li)" ng-repeat="li in unidad.subtext.left.ul.li" ng-bind-html="interpretar(li[lang])"></li>
									<li ng-if="!esArray(unidad.subtext.left.ul.li)" ng-bind-html="interpretar(unidad.subtext.left.ul.li[lang])"></li>
								</ul>
							</div>
						</span>
						<span ng-if="unidad.subtext.right.ul != undefined">
							<div class="col-sm-6">
								<ul>
									<li ng-if="esArray(unidad.subtext.right.ul.li)" ng-repeat="li in unidad.subtext.right.ul.li" ng-bind-html="interpretar(li[lang])"></li>
									<li ng-if="!esArray(unidad.subtext.right.ul.li)" ng-bind-html="interpretar(unidad.subtext.right.ul.li[lang])"></li>
								</ul>
							</div>
						</span>
					</div>
				</span>
			</div>
		</div>
	</div>
	<div ng-if="unidad.team != undefined" class="equipo_unidad">
		<div class="container">
			<div class="row">
				<div class="col-xs-12">
					<p class="titulo_equipo">{{unidad.subtitle[lang]}}</p>
				</div>
				<div class="col-xs-12">
					<span ng-if="unidad.team.section != undefined" ng-repeat="section in unidad.team.section">
						<div class="row">
							<p class="subtitulo_equipo">{{section.name[lang]}}</p>
							<div ng-if="esArray(section.person)" class="col-sm-4 person col-xs-6" ng-repeat="person in section.person">
								<div class="name_person">{{person.name[lang]}}</div>
								<img title="{{person.alt[lang]}}" alt="{{person.alt[lang]}}" src="/img/equipo/{{person.img}}">
								<div class="education_person">{{person.education[lang]}}</div>
							</div>
							<div ng-if="!esArray(section.person)" class="col-sm-4 person col-xs-6">
								<div class="name_person">{{section.person.name[lang]}}</div>
								<img title="{{section.person.alt[lang]}}" alt="{{section.person.alt[lang]}}" src="/img/equipo/{{section.person.img}}">
								<div class="education_person">{{section.person.education[lang]}}</div>
							</div>
						</div>
					</span>
					<span ng-if="unidad.team.section == undefined">
						<div ng-if="esArray(unidad.team.person)" class="col-sm-4 person col-xs-6" ng-repeat="person in unidad.team.person">
							<div class="name_person">{{person.name[lang]}}</div>
							<img title="{{person.alt[lang]}}" alt="{{person.alt[lang]}}" src="/img/equipo/{{person.img}}">
							<div class="education_person">{{person.education[lang]}}</div>
						</div>
						<div ng-if="!esArray(unidad.team.person)" class="col-sm-4 person col-xs-6">
							<div class="name_person">{{unidad.team.person.name[lang]}}</div>
							<img title="{{unidad.team.person.alt[lang]}}" alt="{{unidad.team.person.alt[lang]}}" src="/img/equipo/{{unidad.team.person.img}}">
							<div class="education_person">{{unidad.team.person.education[lang]}}</div>
						</div>
					</span>
				</div>
			</div>
		</div>
	</div>
</div>