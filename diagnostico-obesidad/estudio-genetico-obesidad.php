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
			<div class="col-xs-12">
				<?php 
				if (count($xml_code->content->text) > 0) {
					$text = $xml_code->content->text;
					for ($i=0; $i<count($text); $i++) {
						echo '<p>'.traducirStringXml($text[$i]->$_SESSION['lang']).'</p>';
						if (isset($text[$i]->ul)) {
							echo '<ul class="bigli">';
								$lista = $text[$i]->ul->li;
								for ($j=0; $j<count($lista); $j++) {
									echo '
									<li>
										<span>'.traducirStringXml($lista[$j]->$_SESSION['lang']).'</span>';
										if (isset($lista[$j]->ul)) {
											echo '<ul>';
												for ($k=0; $k<count($lista[$j]->ul->li); $k++) {
													echo '<li>'.traducirStringXml($lista[$j]->ul->li[$k]->$_SESSION['lang']).'</li>';
												}
											echo '</ul>';
										}
									echo '
									</li>
									';
								}
							echo '</ul>';
						}
					}
				} else {
					echo '<p>'.$text->$_SESSION['lang'].'</p>';
					if (isset($text->ul)) {
						echo '<ul class="bigli">';
						$lista = $text->ul->li;
						for ($j=0; $j<count($lista); $j++) {
							echo '
									<li>
										<span>'.traducirStringXml($lista[$j]->$_SESSION['lang']).'</span>';
							if (isset($lista[$j]->ul)) {
								echo '<ul>';
								for ($k=0; $k<count($lista[$j]->ul->li); $k++) {
									echo '<li>'.traducirStringXml($lista[$j]->ul->li[$k]->$_SESSION['lang']).'</li>';
								}
								echo '</ul>';
							}
							echo '
									</li>
									';
						}
						echo '</ul>';
					}
				}
				if (isset($xml_code->content->list)) {
					$lista = $xml_code->content->list;
					if (isset($lista->left)) {
						echo '
						<div class="col-sm-6">
							<ul class="bigli">				
						';
								$sublista = $lista->left->ul->li;
								for ($i=0; $i<count($sublista); $i++) {
									echo '<li>';
										echo '<span>'.traducirStringXml($sublista[$i]->$_SESSION['lang']).'</span>';
										if (isset($sublista[$i]->ul)) {
											echo '<ul>';
												for ($j=0; $j<count($sublista[$i]->ul->li); $j++) {
													echo '<li>'.$sublista[$i]->ul->li[$j]->$_SESSION['lang'].'</li>';
												}
											echo '</ul>';
										}
									echo '</li>';
								}
						echo '
							</ul>
						</div>
						';
					}
					if (isset($lista->right)) {
						echo '
						<div class="col-sm-6">
							<ul class="bigli">
						';
								$sublista = $lista->right->ul->li;
								for ($i=0; $i<count($sublista); $i++) {
									echo '<li>';
									echo '<span>'.traducirStringXml($sublista[$i]->$_SESSION['lang']).'</span>';
									if (isset($sublista[$i]->ul)) {
										echo '<ul>';
										for ($j=0; $j<count($sublista[$i]->ul->li); $j++) {
											echo '<li>'.$sublista[$i]->ul->li[$j]->$_SESSION['lang'].'</li>';
										}
										echo '</ul>';
									}
									echo '</li>';
								}
						echo '
							</ul>
						</div>
						';
					}
				}
				?>
			</div>
		</div>
	</div>
</div>