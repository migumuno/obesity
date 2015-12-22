<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/header.php'; ?>
<?php $xml = 'legal'; ?>

<div class="metodo">
	<div class="container">
		<?php 
		$text = $xml_code->content->text;
		for ($i=0; $i<count($text); $i++) {
			echo '<p>'.traducirStringXml($text[$i]->$_SESSION['lang']).'</p>';
			for ($h=0; $h<count($text[$i]->ul); $h++) {
				echo '<ul>';
					for ($j=0; $j<count($text[$i]->ul[$h]->li); $j++) {
						echo '<li>';
							echo '<p>'.traducirStringXml($text[$i]->ul[$h]->li[$j]->$_SESSION['lang']).'</p>';
							echo '<p>'.traducirStringXml($text[$i]->ul[$h]->li[$j]->text->$_SESSION['lang']).'</p>';
						echo '</li>';
					}
				echo '</ul>';
			}
		}
		?>
	</div>
</div>

<?php include $_SERVER['DOCUMENT_ROOT'].'/includes/footer.php'; ?>