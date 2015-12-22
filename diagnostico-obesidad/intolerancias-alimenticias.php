<div class="metodo">
	<div class="container">
		<?php 
		if (isset($xml_code->breadcrumbs)) {
			echo '<ol class="breadcrumb">';
			$breadcrumbs = $xml_code->breadcrumbs->item;
			if (count($breadcrumbs) > 0)	{
				for ($i=0; $i<count($breadcrumbs); $i++) {
					echo '<li><a href="/'.$_SESSION['lang'].$breadcrumbs[$i]->link->$_SESSION['lang'].'">'.$breadcrumbs[$i]->name->$_SESSION['lang'].'</a></li>';
				}
			} else {
				echo '<li><a href="/'.$_SESSION['lang'].$breadcrumbs->link->$_SESSION['lang'].'">'.$breadcrumbs->name->$_SESSION['lang'].'</a></li>';
			}
			echo '<li class="active">'.$xml_code->breadcrumbs->active->name->$_SESSION['lang'].'</li>';
			echo '</ol>';
		}
		?>
		<div class="row">
			<div class="col-sm-6 padding20">
				<?php 
				$text = $xml_code->content->left->text;
				for ($i=0; $i<count($text); $i++) {
					echo '<p>'.traducirStringXml($text[$i]->$_SESSION['lang']).'</p>';
					if (isset($text[$i]->ul)) {
						echo '<ul class="bigli">';
							for ($j=0; $j<count($text[$i]->ul->li); $j++) {
								echo '<li>'.traducirStringXml($text[$i]->ul->li[$j]->$_SESSION['lang']).'</li>';
							}
						echo '</ul>';
					}
				}
				?>
			</div>
			<div class="col-sm-6 padding20">
				<?php 
				$text = $xml_code->content->right->text;
				for ($i=0; $i<count($text); $i++) {
					echo '<p>'.traducirStringXml($text[$i]->$_SESSION['lang']).'</p>';
					if (isset($text[$i]->ul)) {
						echo '<ul class="bigli">';
							for ($j=0; $j<count($text[$i]->ul->li); $j++) {
								echo '<li>'.traducirStringXml($text[$i]->ul->li[$j]->$_SESSION['lang']).'</li>';
							}
						echo '</ul>';
					}
				}
				?>
			</div>
		</div>
	</div>
</div>