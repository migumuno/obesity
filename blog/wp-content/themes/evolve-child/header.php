<?php
$url_base = 'http://88.12.14.37';
/**
* Template: Header.php
*
* @package EvoLve
* @subpackage Template
*/

$temp = $_SERVER['REQUEST_URI'];
$temp = substr($temp, 0, 8);
	
if (strpos($temp, '/es/') !== false || strpos($temp, '/es') !== false)
	$lang = 'es';
else if (strpos($temp, '/en/') !== false || strpos($temp, '/en') !== false)
	$lang = 'en';
else if (strpos($temp, '/de/') !== false || strpos($temp, '/de') !== false)
	$lang = 'de';
?>
<!DOCTYPE html>
<!--BEGIN html-->
<html <?php language_attributes(); ?>>
<!--BEGIN head-->
<head>

<?php $evolve_favicon = evolve_get_option('evl_favicon'); if( $evolve_favicon ) { ?>
<!-- Favicon -->
<!-- Firefox, Chrome, Safari, IE 11+ and Opera. -->
<link href="<?php echo $evolve_favicon; ?>" rel="icon" type="image/x-icon" />
<?php } ?>

<!-- Meta Tags -->
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo('charset'); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>

<!--[if lt IE 9]>
<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/ie.css">
<![endif]-->
<script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>

</head><!--END head-->

<!--BEGIN body-->
<body <?php body_class(); ?>>

<?php $evolve_custom_background = evolve_get_option('evl_custom_background','1'); if ($evolve_custom_background == "1") { ?>
<div id="wrapper">
<?php } ?>

<div id="top">
	<div class="lang">
			<div class="container">
				<div class="row">
					<div class="col-xs-12">
						<div class="col-sm-6 lang_left">
							<ul>
								<?php if ($lang != 'es') {?><li ng-hide="lang=='es'"><a href="/blog/es"><img alt="español" src="/img/es.png"> <small>Español</small></a></li><?php } ?>
								<?php if ($lang != 'en') {?><li ng-hide="lang=='en'"><a href="/blog/en"><img alt="english" src="/img/en.png"> <small>English</small></a></li><?php } ?>
								<?php if ($lang != 'de') {?><li ng-hide="lang=='de'"><a href="/blog/de"><img alt="deutsch" src="/img/de.png"> <small>Deutsch</small></a></li><?php } ?>
							</ul>
						</div>
						<!-- <div class="col-sm-6 lang_right">
							<ul>
								<li><img alt="facebook" src="/img/icons/facebook1.png"></li>
								<li><img alt="twitter" src="/img/icons/twitter1.png"></li>
								<li><img alt="rss" src="/img/icons/blog1.png"></li>
								<li><img alt="youtube" src="/img/icons/youtube.png"></li>
								<li><button class="boton_admin"><img alt="area del paciente" src="/img/icons/lock.png"> Area del Paciente</button></li>
							</ul>
						</div> -->
					</div>
				</div>
			</div>
		</div>
	
		<div  class="skype">
			<div class="container">
				<script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
				<div id="SkypeButton_Call_ObesityHealthSpain_2">
				  <script type="text/javascript">
				    Skype.ui({
				      "name": "call",
				      "element": "SkypeButton_Call_ObesityHealthSpain_2",
				      "participants": ["ObesityHealthSpain"],
					   "imageColor": "blue",
				      "imageSize": 24
				    });
				  </script>
				</div>
			</div>
		</div>
</div>

<!--BEGIN .header-->
<div class="header visible-lg-block <?php $evolve_width_layout = evolve_get_option('evl_width_layout','fixed'); if( get_header_image() && $evolve_width_layout == "fluid" ): echo 'custom-header'; endif;?>">

	<!--BEGIN .container-->
	<div class="container container-header <?php $evolve_width_layout = evolve_get_option('evl_width_layout','fixed'); if( get_header_image() && $evolve_width_layout == "fixed" ): echo 'custom-header'; endif;?>">
	
	<?php $evolve_social_links = evolve_get_option('evl_social_links','1'); if ( $evolve_social_links == "1" ) { ?>
	
		<!--BEGIN #righttopcolumn-->
		<!-- <div id="righttopcolumn"> -->
		
			<!--BEGIN #subscribe-follow-->
			
			<!-- <div id="social">
			<?php /*get_template_part('social-buttons', 'header');*/ ?>
			</div> -->
			
			<!--END #subscribe-follow-->
		
		<!-- </div> -->
		<!--END #righttopcolumn-->
	
	<?php } ?>
	
	<?php $evolve_pos_logo = evolve_get_option('evl_pos_logo','left'); if ($evolve_pos_logo == "disable") { ?>
	
	<?php } else { ?>
	
	<?php $evolve_header_logo = evolve_get_option('evl_header_logo', '');
	if ($evolve_header_logo) {
		
	echo '
	<div class="cabecera">
		<div class="row">
			<div class="col-xs-12">
				<div class="col-md-4 logo"><a href="/'.$lang.'"><img id="logo-image" alt="emio" class="img-responsive" src="'.$evolve_header_logo.'"></a></div>
				<div class="col-md-8">european medical institute of obesity</div>
			</div>
		</div>
	</div>
	';
	}
	?>
	
	<?php } ?>
	
		<!--BEGIN .title-container-->
		<div class="title-container">
		<?php
		
		$tagline = '<div id="tagline">'.get_bloginfo( 'description' ).'</div>';
		
		$evolve_tagline_pos = evolve_get_option('evl_tagline_pos','next');
		
		if (($evolve_tagline_pos !== "disable") && ($evolve_tagline_pos == "above")) {
		
		echo $tagline;
		
		} ?>
		
		
		<?php $evolve_blog_title = evolve_get_option('evl_blog_title','0');
		if ($evolve_blog_title == "0" || !$evolve_blog_title) { ?>
		
			<div id="logo"><a href="<?php echo home_url(); ?>"><?php bloginfo( 'name' ) ?></a></div>
		
		<?php } else { ?>
		
		<?php } if (($evolve_tagline_pos !== "disable") && (($evolve_tagline_pos == "") || ($evolve_tagline_pos == "next") || ($evolve_tagline_pos == "under")))
		{
			echo $tagline;
		
		} ?>
		
		<!--END .title-container-->
		</div>
	
	<!--END .container-->
	</div>

<!--END .header-->
</div>


<div class="menu-container">

<?php $evolve_menu_background = evolve_get_option('evl_disable_menu_back','1'); $evolve_width_layout = evolve_get_option('evl_width_layout','fixed'); if ( $evolve_width_layout == "fluid" && $evolve_menu_background == "1" ) { ?>

	<div class="fluid-width">
	
	<?php } ?>
	
		<div class="menu-header">
		
			<!--BEGIN .container-menu-->
			<div class="container nacked-menu container-menu">
			
			<?php $evolve_main_menu = evolve_get_option('evl_main_menu','0'); if ($evolve_main_menu == "1") { ?>
			<br /><br />
			
			<?php } else { ?>
			
				<div class="primary-menu">
				<?php				
				if ( has_nav_menu( 'primary-menu' ) ) {				
					echo '<nav id="nav" class="nav-holder link-effect">';
					wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'nav-menu','fallback_cb' => 'wp_page_menu', 'walker' => new evolve_Walker_Nav_Menu() ) );
				} else { ?>
					<nav id="nav" class="nav-holder">
					<?php wp_nav_menu( array( 'theme_location' => 'primary-menu', 'menu_class' => 'nav-menu','fallback_cb' => 'wp_page_menu') );} ?>
					</nav>
				</div><!-- /.primary-menu -->
			
			
			<?php $evolve_searchbox = evolve_get_option('evl_searchbox','1'); if ( $evolve_searchbox == "1" ) { ?>
			
			<!--BEGIN #searchform-->
			<form action="<?php echo home_url(); ?>" method="get" class="searchform">
				<div id="search-text-box">
				<label class="searchfield" id="search_label_top" for="search-text-top"><input id="search-text-top" type="text" tabindex="1" name="s" class="search" placeholder="<?php _e( 'Type your search', 'evolve' ); ?>" /></label>
				</div>
			</form>
			
			<div class="clearfix"></div>
			
			<!--END #searchform-->
			
			<?php } ?>
			
			
			<?php $evolve_sticky_header = evolve_get_option('evl_sticky_header','1'); if ( $evolve_sticky_header == "1" ) {
			
			// sticky header
			get_template_part('sticky-header');
			
			} ?>
			
			<?php } ?>
			
			</div><!-- /.container -->
		
		</div><!-- /.menu-header -->
	
		<div class="menu-back">
		
		<?php $evolve_slider_page_id = ''; $evolve_bootstrap = evolve_get_option('evl_bootstrap_slider','homepage');
		if(!is_home() && !is_front_page() && !is_archive()) {
			$evolve_slider_page_id = $post->ID;
		}
		if(!is_home() && is_front_page()) {
			$evolve_slider_page_id = $post->ID;
		}
		if(is_home() && !is_front_page()){
			$evolve_slider_page_id = get_option('page_for_posts');
		}
		
		if(get_post_meta($evolve_slider_page_id, 'evolve_slider_type', true) == 'bootstrap' || ($evolve_bootstrap == "homepage" && is_front_page()) || $evolve_bootstrap == "all" ):
		
			evolve_bootstrap();
		
		endif; ?>
		
		
		<?php $evolve_slider_page_id = ''; $evolve_parallax = evolve_get_option('evl_parallax_slider','post');
		if(!is_home() && !is_front_page() && !is_archive()) {
			$evolve_slider_page_id = $post->ID;
		}
		if(!is_home() && is_front_page()) {
			$evolve_slider_page_id = $post->ID;
		}
		if(is_home() && !is_front_page()){
			$evolve_slider_page_id = get_option('page_for_posts');
		}
		
		if(get_post_meta($evolve_slider_page_id, 'evolve_slider_type', true) == 'parallax' || ($evolve_parallax == "homepage" && is_front_page()) || $evolve_parallax == "all" ):
		
			$evolve_parallax_slider = evolve_get_option('evl_parallax_slider_support', '1');
		
			if ($evolve_parallax_slider == "1"):
		
				evolve_parallax();
		
			endif;
		
		endif; ?>
		
		
		<?php $evolve_posts_slider = evolve_get_option('evl_posts_slider','post');
		
		if(get_post_meta($evolve_slider_page_id, 'evolve_slider_type', true) == 'posts' || ($evolve_posts_slider == "homepage" && is_front_page()) || $evolve_posts_slider == "all" ):

			$evolve_carousel_slider = evolve_get_option('evl_carousel_slider', '1');
		
			if ($evolve_carousel_slider == "1"):
		
				evolve_posts_slider();
		
			endif;
		
		endif; ?>
		
			<?php $evolve_width_layout = evolve_get_option('evl_width_layout','fixed'); if ( $evolve_width_layout == "fluid" ) { ?>
		
			<div class="container">
			
			<?php } ?>
			
			<?php $evolve_header_widgets_placement = evolve_get_option('evl_header_widgets_placement', 'home');
			$evolve_widget_this_page = get_post_meta($post->ID, 'evolve_widget_page', true);
			if (((is_home() || is_front_page()) && $evolve_header_widgets_placement == "home") || (is_single() && $evolve_header_widgets_placement == "single") || (is_page() && $evolve_header_widgets_placement == "page") || ($evolve_header_widgets_placement == "all") || ($evolve_widget_this_page == "yes" && $evolve_header_widgets_placement == "custom")) { ?>
			
			<?php $evolve_widgets_header = evolve_get_option('evl_widgets_header','disable');
			
			// if Header widgets exist
			
			if (($evolve_widgets_header == "") || ($evolve_widgets_header == "disable"))
			{ } else { ?>
			
			
			<?php
			
			$evolve_header_css = '';
			
			if ($evolve_widgets_header == "one") { $evolve_header_css = 'widget-one-column col-sm-6'; }
			
			if ($evolve_widgets_header == "two") { $evolve_header_css = 'col-sm-6 col-md-6'; }
			
			if ($evolve_widgets_header == "three") { $evolve_header_css = 'col-sm-6 col-md-4'; }
			
			if ($evolve_widgets_header == "four") { $evolve_header_css = 'col-sm-6 col-md-3'; }
			
			?>
			
			<div class="container">
				<div class="widgets-back-inside row">
				
				<div class="<?php echo $evolve_header_css; ?>">
					<?php if ( !dynamic_sidebar( 'header-1' )) : ?>
					<?php endif; ?>
				</div>
				
				<div class="<?php echo $evolve_header_css; ?>">
					<?php if ( !dynamic_sidebar( 'header-2' ) ) : ?>
					<?php endif; ?>
				</div>
				
				<div class="<?php echo $evolve_header_css; ?>">
					<?php if ( !dynamic_sidebar( 'header-3' ) ) : ?>
					<?php endif; ?>
				</div>
				
				<div class="<?php echo $evolve_header_css; ?>">
					<?php if ( !dynamic_sidebar( 'header-4' ) ) : ?>
					<?php endif; ?>
				</div>
				
				</div>
			</div><!-- /.container -->
			
			
			<?php } ?>
			
			<?php } else {} ?>
			
			
			</div><!-- /.container -->
		
		
		</div><!--/.menu-back-->
	
	
<?php $evolve_width_layout = evolve_get_option('evl_width_layout','fixed'); if ( $evolve_width_layout == "fluid" ) { ?>
	
	</div><!-- /.fluid-width -->

<?php } ?>

<!--BEGIN .content-->
<div class="content <?php semantic_body(); ?>">

<?php if (is_page_template('contact.php')): ?>
<div class="gmap" id="gmap"></div>
<?php endif; ?>

<!--BEGIN .container-->
<div class="container container-center row">

<!--BEGIN #content-->
<div id="content">

<?php if (is_front_page()) {

	evolve_content_boxes();

} ?>