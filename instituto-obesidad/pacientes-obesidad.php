<div class="metodo">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php 
				$texto = $xml_code->content->text;
				if (count($texto) > 0) {
					for ($i=0; $i<count($texto); $i++) {
						echo '<p>'.traducirStringXml($texto[$i]->$_SESSION['lang']).'</p>';
						if (isset($texto[$i]->ul)) {
							echo '<ul class="bigli">';
								for ($j=0; $j<count($texto[$i]->ul->li); $j++) {
									echo '<li>'.traducirStringXml($texto[$i]->ul->li[$j]->$_SESSION['lang']).'</li>';
								}
							echo '</ul>';
						}
					}
				} else {
					echo '<p>'.traducirStringXml($texto->$_SESSION['lang']).'</p>';
					if (isset($texto->ul)) {
						echo '<ul class="bigli">';
						for ($j=0; $j<count($texto->ul->li); $j++) {
							echo '<li>'.traducirStringXml($texto->ul->li[$j]->$_SESSION['lang']).'</li>';
						}
						echo '</ul>';
					}
				}
				?>
			</div>
			<div class="col-sm-6 padding20">
				<?php 
				$texto = $xml_code->content->left->text;
				if (count($texto) > 0) {
					for ($i=0; $i<count($texto); $i++) {
						echo '<p>'.traducirStringXml($texto[$i]->$_SESSION['lang']).'</p>';
						if (isset($texto[$i]->ul)) {
							echo '<ul class="bigli">';
								for ($j=0; $j<count($texto[$i]->ul->li); $j++) {
									echo '<li>'.traducirStringXml($texto[$i]->ul->li[$j]->$_SESSION['lang']).'</li>';
								}
							echo '</ul>';
						}
					}
				} else {
					echo '<p>'.traducirStringXml($texto->$_SESSION['lang']).'</p>';
					if (isset($texto->ul)) {
						echo '<ul class="bigli">';
						for ($j=0; $j<count($texto->ul->li); $j++) {
							echo '<li>'.traducirStringXml($texto->ul->li[$j]->$_SESSION['lang']).'</li>';
						}
						echo '</ul>';
					}
				}
				?>
			</div>
			<div class="col-sm-6 padding20">
				<?php 
				$texto = $xml_code->content->right->text;
				if (count($texto) > 0) {
					for ($i=0; $i<count($texto); $i++) {
						echo '<p>'.traducirStringXml($texto[$i]->$_SESSION['lang']).'</p>';
						if (isset($texto[$i]->ul)) {
							echo '<ul class="bigli">';
								for ($j=0; $j<count($texto[$i]->ul->li); $j++) {
									echo '<li>'.traducirStringXml($texto[$i]->ul->li[$j]->$_SESSION['lang']).'</li>';
								}
							echo '</ul>';
						}
					}
				} else {
					echo '<p>'.traducirStringXml($texto->$_SESSION['lang']).'</p>';
					if (isset($texto->ul)) {
						echo '<ul class="bigli">';
						for ($j=0; $j<count($texto->ul->li); $j++) {
							echo '<li>'.traducirStringXml($texto->ul->li[$j]->$_SESSION['lang']).'</li>';
						}
						echo '</ul>';
					}
				}
				?>
			</div>
		</div>
	</div>
</div>