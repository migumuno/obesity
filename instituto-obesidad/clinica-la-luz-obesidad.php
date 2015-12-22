<div class="metodo">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 padding20">
				<img title="<?php echo $xml_code->content->alt->$_SESSION['lang'] ?>" src="/img/<?php echo $xml_code->content->img ?>" alt="<?php echo $xml_code->content->alt->$_SESSION['lang'] ?>">
			</div>
			<div class="col-sm-6 padding20">
				<?php 
				$text = $xml_code->content->right->text;
				for ($i=0; $i<count($text); $i++) {
					echo '<p>'.traducirStringXml($text[$i]->$_SESSION['lang']).'</p>';
					if (isset($text[$i]->ul)) {
						echo '<ul class="bigli">';
							for ($j=0; $j<count($text[$i]->ul->li); $j++) {
								echo '<li><span>'.traducirStringXml($text[$i]->ul->li[$j]->$_SESSION['lang']).'</span></li>';
							}
						echo '</ul>';
					}
				}
				?>
			</div>
			<div class="col-xs-12">
				<?php
				$text = $xml_code->content->text;
				if (count($text) > 0) {
					for ($i=0; $i<count($text); $i++) {
						echo '<p>'.traducirStringXml($text[$i]->$_SESSION['lang']).'</p>';
						if (isset($text[$i]->ul)) {
							echo '<ul class="bigli">';
							for ($j=0; $j<count($text[$i]->ul->li); $j++) {
								echo '<li><span>'.traducirStringXml($text[$i]->ul->li[$j]->$_SESSION['lang']).'</span></li>';
							}
							echo '</ul>';
						}
					}
				} else {
					echo '<p>'.traducirStringXml($text->$_SESSION['lang']).'</p>';
					if (isset($text->ul)) {
						echo '<ul class="bigli">';
						for ($j=0; $j<count($text->ul->li); $j++) {
							echo '<li><span>'.traducirStringXml($text->ul->li[$j]->$_SESSION['lang']).'</span></li>';
						}
						echo '</ul>';
					}
				}
				$lista = $xml_code->content->list;
				if (isset($lista)) {
					if (isset($lista->left)) {
						echo '<div class="col-sm-6">
							<ul class="bigli">';
								for ($i=0; $i<count($lista->left->ul->li); $i++) {
									echo '<li>'.traducirStringXml($lista->left->ul->li[$i]->$_SESSION['lang']).'</li>';
								}
						echo '</ul>
						</div>';
					}
					if (isset($lista->right)) {
						echo '<div class="col-sm-6">
							<ul class="bigli">';
								for ($i=0; $i<count($lista->right->ul->li); $i++) {
									echo '<li>'.traducirStringXml($lista->right->ul->li[$i]->$_SESSION['lang']).'</li>';
								}
						echo '</ul>
						</div>';
					}
				}
				?>
			</div>
		</div>
	</div>
</div>