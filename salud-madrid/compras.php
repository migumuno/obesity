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
				}
				?>
			</div>
			<div class="col-sm-6 padding20">
				<?php 
				$text = $xml_code->content->right->text;
				for ($i=0; $i<count($text); $i++) {
					echo '<p>'.traducirStringXml($text[$i]->$_SESSION['lang']).'</p>';
				}
				?>
			</div>
		</div>
	</div>
</div>
<div class="caracteristicas_metodo">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php 
				$tarjetas = $xml_code->content->cards->card;
				for ($i=0; $i<count($tarjetas); $i++) {
					echo '
					<div class="col-md-3 col-sm-6 caracteristica_metodo">
						<div class="titulo_caracteristica">'.$tarjetas[$i]->title->$_SESSION['lang'].'</div>
						<div class="contenido_caracteristica">
							<img title="'.$tarjetas[$i]->alt->$_SESSION['lang'].'" src="/img/'.$tarjetas[$i]->img.'" alt="'.$tarjetas[$i]->alt->$_SESSION['lang'].'">
							<div class="txt_compras">';
								for ($j=0; $j<count($tarjetas[$i]->text); $j++) {
									echo '<p>'.traducirStringXml($tarjetas[$i]->text[$j]->$_SESSION['lang']).'</p>';
								}
							echo '
							</div>
						</div>
					</div>
					';
				}
				?>
			</div>
		</div>
	</div>
</div>