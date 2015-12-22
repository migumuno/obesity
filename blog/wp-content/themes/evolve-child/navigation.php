<?php
/**
 * Template: Navigation.php 
 *
 * @package EvoLve
 * @subpackage Template
 */
$evolve_pagination_type = evolve_get_option('evl_pagination_type', 'pagination');

if ( is_singular() and !is_page() ) { 

$temp = $_SERVER['REQUEST_URI'];
$temp = substr($temp, 0, 8);
	
if (strpos($temp, '/es/') !== false || strpos($temp, '/es') !== false)
	$lang = 'es';
else if (strpos($temp, '/en/') !== false || strpos($temp, '/en') !== false)
	$lang = 'en';
else if (strpos($temp, '/de/') !== false || strpos($temp, '/de') !== false)
	$lang = 'de';
	
$text = array(
	"es" => array(
		"prev" => "Anterior",
		"next" => "Siguiente"
	),
	"en" => array(
		"prev" => "Previous",
		"next" => "Next"
	),
	"de" => array(
		"prev" => "Nächster",
		"next" => "Vorheriger"
	)
);
?>
<!--BEGIN .navigation-links-->
<div class="navigation-links single-page-navigation clearfix row">
	<div class="col-sm-6 col-md-6 nav-previous"><?php previous_post_link( '%link', '<div class="btn btn-left icon-arrow-left icon-big">'.$text[$lang]['prev'].'</div>' ); ?></div>
	<div class="col-sm-6 col-md-6 nav-next"><?php next_post_link( '%link', '<div class="btn btn-right icon-arrow-right icon-big">'.$text[$lang]['next'].'</div>' ); ?></div>
<!--END .navigation-links-->
</div>
<div class="clearfix"></div> 
<?php } else { ?>
<!--BEGIN .navigation-links-->
<div class="navigation-links page-navigation clearfix">
<?php if (function_exists('wp_pagenavi')) : ?>
        <?php wp_pagenavi(); ?>
    <?php else: ?>
	<div class="col-sm-6 col-md-6 nav-next"><?php previous_posts_link( '<div class="btn btn-left icon-arrow-left icon-big">'.__( 'Newer Entries', 'evolve' ).'</div>' ); ?></div>
  <div class="col-sm-6 col-md-6 nav-previous"><?php next_posts_link( '<div class="btn btn-right icon-arrow-right icon-big">'.__( 'Older Entries', 'evolve' ).'</div>' ); ?></div>
  <?php endif; ?>
<!--END .navigation-links-->
</div>
<div class="clearfix"></div> 

<?php } ?>