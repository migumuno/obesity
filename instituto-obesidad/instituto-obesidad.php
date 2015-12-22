<div class="metodo">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 padding20">
				<img title="<?php echo $xml_code->content->alt->$_SESSION['lang'] ?>" src="/img/<?php echo $xml_code->content->img ?>" alt="<?php echo $xml_code->content->alt->$_SESSION['lang'] ?>">
			</div>
			<div class="col-sm-6 padding20">
				<?php 
				$text = $xml_code->content->text;
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
<div class="caracteristicas_metodo">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<?php 
				$tarjetas = $xml_code->content->cards->card;
				for ($i=0; $i<count($tarjetas); $i++) {
					echo '<div class="col-md-3 col-sm-6 caracteristica_metodo">';
						echo '<div class="titulo_caracteristica">'.$tarjetas[$i]->title->$_SESSION['lang'].'</div>';
						echo '<div class="contenido_caracteristica">';
							echo '<img title="'.$tarjetas[$i]->alt->$_SESSION['lang'].'" src="/img/'.$tarjetas[$i]->img.'" alt="'.$tarjetas[$i]->alt->$_SESSION['lang'].'">';
							echo '<div class="txt_nosotros">';
								if (count($tarjetas[$i]->text) > 0) {
									for ($j=0; $j<count($tarjetas[$i]->text); $j++) {
										echo '<p>'.traducirStringXml($tarjetas[$i]->text[$j]->$_SESSION['lang']).'</p>';
									}
								} else
									echo '<p>'.traducirStringXml($tarjetas[$i]->text->$_SESSION['lang']).'</p>';
							echo '</div>'; 
							echo '<div class="boton_diagnostico"><a href="/'.$_SESSION['lang'].$tarjetas[$i]->link->$_SESSION['lang'].'"><button class="boton">'.$diccionario->buttons->more_info->$_SESSION['lang'].'</button></a></div>';
						echo '</div>';
					echo '</div>';
				}
				?>
			</div>
		</div>
	</div>
</div>