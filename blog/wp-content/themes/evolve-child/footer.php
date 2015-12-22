<?php
/**
* Template: Footer.php
*
* @package EvoLve
* @subpackage Template
*/
$temp = $_SERVER['REQUEST_URI'];
if (strpos($temp, '/es/') !== false || strpos($temp, '/es') !== false)
	$lang = 'es';
else if (strpos($temp, '/en/') !== false || strpos($temp, '/en') !== false)
	$lang = 'en';
else if (strpos($temp, '/de/') !== false || strpos($temp, '/de') !== false)
	$lang = 'de';
else 
	$lang = 'es';
$xml_code = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/xml/footer.xml');
$creditos = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/xml/creditos.xml');
$dictionary = simplexml_load_file($_SERVER['DOCUMENT_ROOT'].'/xml/dictionary.xml');
?>
<!--END #content-->
</div>
<!--END .container-->
</div>
<!--END .content-->
</div>
<!--BEGIN .content-bottom-->
<div class="content-bottom">
<!--END .content-bottom-->
</div>
<!--BEGIN .footer-->
<div class="footer">
	<!--BEGIN .container-->
	<div class="container container-footer">
		<div class="row">
			<div class="col-xs-12">
				<div class="col-md-15 col-sm-4 col-xs-12 item_footer_logo">
					<ul>
						<li><img alt="emio" src="/img/logo_footer.png"></li>
						<li>
							<span class="row">
								<span class="col-xs-2"><img alt="dirección" src="/img/icons/pin.png"></span>
								<span class="col-xs-10">Paseo de la Habana, 63 28036 Madrid</span>
							</span>
						</li>
						<li>
							<span class="row">
								<span class="col-xs-2"><img alt="teléfono" src="/img/icons/phone.png"></span>
								<span class="col-xs-10"><a href="tel:+34900104050">+34 900 10 40 50</a><br></span>
							</span>
						</li>
						<li>
							<span class="row">
								<span class="col-xs-2"><img alt="email" src="/img/icons/mail.png"></span>
								<span class="col-xs-10"><a href="mailto:info@obesity.es">info@obesity.es</a></span>
							</span>
						</li>
					</ul>
				</div>
				<?php 
				foreach ($xml_code->section as $section) {
					echo '
					<div class="col-md-15 col-sm-4 col-xs-12 item_footer">
						<div class="titulo titulo_footer">'.$section->title->$lang.'</div>
						<ul>';
							foreach ($section->items->item as $item) {
								echo '<li><a href="'.$url_base.'/'.$lang.$item->link->$lang.'">'.$item->name->$lang.'</a></li>';
							}
						echo '</ul>
					</div>
					';
				}
				?>
			</div>
		</div>
	</div>
	<!--END .footer-->
</div>
<div class="creditos">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php
				$i = 0;
				foreach ($creditos->item as $item) {
					if ($i == 0 || $i == 4)
						echo '<div class="col-md-6 col-xs-12">';
					echo '<div class="col-sm-3 col-xs-6"><img alt="'.$item->alt->$lang.'" src="/img/'.$item->img.'" width="100%"></div>';
					if ($i == 3 || $i == 7)
						echo '</div>';
					$i++;
				}
				?>
			</div>
		</div>
	</div>
</div>
<div class="legal">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div class="col-md-6 col-xs-12">
					&#169; European medical institute of obesity
				</div>
				<div class="col-md-6 col-xs-12 legal_right">
					<ul>
						<li class="legal_li"><a href="/<?php echo $lang ?>/legal"><?php echo $dictionary->texts->legal->$lang ?></a></li>
						<li class="legal_li"><a href="/<?php echo $lang ?>/legal"><?php echo $dictionary->texts->privacity->$lang ?></a></li>
						<li class="legal_last"><a href="/<?php echo $lang ?>/legal"><?php echo $dictionary->texts->cookies->$lang ?></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!--END body-->
			<?php $evolve_pos_button = evolve_get_option('evl_pos_button','right');
			if ($evolve_pos_button == "disable" || $evolve_pos_button == "") { ?>
			<?php } else { ?>
				<div id="backtotop"><a href="#top" id="top-link"></a></div>
				<?php } ?>
				<?php $evolve_custom_background = evolve_get_option('evl_custom_background','0'); if ($evolve_custom_background == "1") { ?>
				</div>
			<?php } ?>
		<?php wp_footer(); ?>
	</body>
<!--END html(kthxbye)-->
</html>