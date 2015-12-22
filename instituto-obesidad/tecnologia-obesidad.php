<div class="metodo">
	<div class="container">
		<div class="row">
			<div class="col-sm-6 padding20">
				<img title="<?php echo $xml_code->content->alt->$_SESSION['lang'] ?>" src="/img/<?php echo $xml_code->content->img ?>" alt="<?php echo $xml_code->content->alt->$_SESSION['lang'] ?>">
			</div>
			<div class="col-sm-6 padding20">
				<?php 
				$texto = $xml_code->content->text;
				for ($i=0; $i<count($texto); $i++) {
					echo '<p>'.traducirStringXml($texto[$i]->$_SESSION['lang']).'</p>';
					if (isset($texto[$i]->ul)) {
						echo '<ul class="bigli">';
							for ($j=0; $j<count($texto[$i]->ul->li); $j++) {
								if (isset($texto[$i]->ul->li[$j]->link))
									echo '<li><a href="/'.$texto[$i]->ul->li[$j]->link.'">'.traducirStringXml($texto[$i]->ul->li[$j]->$_SESSION['lang']).'</a></li>';
								else
									echo '<li><span>'.traducirStringXml($texto[$i]->ul->li[$j]->$_SESSION['lang']).'</span></li>';
							}
						echo '</ul>';
					}
				}
				?>
			</div>
		</div>
	</div>
</div>