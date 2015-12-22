<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>
<?php $xml = 'legal'; ?>

<div class="metodo">
	<div class="container">
		<span ng-repeat="text in contenido.content.text">
			<p ng-bind-html="interpretar(text[lang])"></p>
			<ul ng-repeat="ul in text.ul">
				<li ng-repeat="li in ul.li">
					<p ng-bind-html="interpretar(li[lang])"></p>
					<p ng-bind-html="interpretar(li.text[lang])"></p>
				</li>
				<br>
			</ul>
		</span>
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>